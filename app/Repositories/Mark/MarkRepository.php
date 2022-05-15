<?php

namespace App\Repositories\Mark;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Base\BaseRepository;

class MarkRepository extends BaseRepository implements MarkRepositoryInterface
{
    protected $student;
    protected $subject;

    public function __construct(Mark $mark, Student $student, Subject $subject)
    {
        parent::__construct($mark);
        $this->subject = $subject;
        $this->student = $student;
    }

    public function getAllList()
    {
        return $this->model->orderBy('student_id','desc')->with('subject')->with('student')->paginate(8);
    }

    public function findStudent($id) {

        $marks = $this->model->where('student_id',$id);

        return $marks;
    }

    public function checkMark($request) {

    }

    public function query() {
        return $this->model->query();
    }
}

?>