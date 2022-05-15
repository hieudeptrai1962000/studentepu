<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;


class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(Student $student)
    {
        parent::__construct($student);

    }

    public function checkAvatar($avatar)
    {
        return $this->model->where('avatar', $avatar);
    }

    public function searchStudent($data, $count_subjects)
    {
        $students = $this->model->with('classRelation');
        // Age filter
        if (!empty($data['min_age'])) {
            $min = Carbon::now()->subYears($data['min_age']);
            $students->where('birthday', '<=', $min);
        }

        if (!empty($data['max_age'])) {
            $max = Carbon::now()->subYears($data['max_age']);
            $students->where('birthday', '>=', $max);
        }
        //Phone filter
        if (!empty($data['phones'])) {
            $students->where(function ($query) use ($data) {
                foreach ($data['phones'] as $key => $phone) {
                    $query->orWhere('phone_number', 'regexp', $phone);
                }
            });
        }
        //Subject filter
        if (!empty($data['subject_id'])) {
            $students->whereHas('marks', function ($query) use ($data) {
                $query->where('subject_id', $data['subject_id']);
            });
        }
        //Mark filter
        if (!empty($data['min_mark'])) {
            $students->whereHas('marks', function ($query) use ($data) {
                if (!empty($data['subject_id'])) {
                    $query = $query->where('subject_id', $data['subject_id']);
                }

                $query->where('mark', '>=', $data['min_mark']);
            });
        }

        if (!empty($data['max_mark'])) {
            $students->whereHas('marks', function ($query) use ($data) {
                if (!empty($data['subject_id'])) {
                    $query = $query->where('subject_id', $data['subject_id']);
                }

                $query->where('mark', '<=', $data['max_mark']);
            });
        }

        // Done all subject ?
        if (!empty($data['done']) && empty($data['not_done'])) {
            $students->has('subjects', '=', $count_subjects);
        }

        if (!empty($data['not_done']) && empty($data['done'])) {
            $students->has('subjects', '<', $count_subjects);
        }

        //AVG < 5 ?
        if (!empty($data['less_5']) && empty($data['greater_5'])) {

                $students->has('subjects', '=', $count_subjects)
                    ->whereHas('marks', function ($query) {
                        $query->havingRaw('AVG(mark) < 5');
                    });
        }
        if (!empty($data['greater_5']) && empty($data['less_5'])) {

                $students->has('subjects', '=', $count_subjects)
                    ->whereHas('marks', function ($query) {
                        $query->havingRaw('AVG(mark) >= 5');
                    });
        }

        return $students->paginate(10);
    }

    public function badStudents()
    {
        $count_subjects = Subject::all()->count();
        $students = $this->model->has('subjects', '=', $count_subjects)
            ->whereHas('marks', function ($query) {
                $query->havingRaw('AVG(mark) < 5');
            });

        return $students->paginate(5);

    }
}

?>
