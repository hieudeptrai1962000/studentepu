<?php
namespace App\Repositories\Subject;
use App\Models\Faculty;
use App\Models\Mark;
use App\Models\Subject;
use App\Repositories\Base\BaseRepository;
class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface {
    protected $mark;
    protected $faculty;
    public function __construct(Subject $subject, Mark $mark, Faculty $faculty){
        parent::__construct($subject);
        $this->mark= $mark;
        $this->faculty= $faculty;
    }

    public function showMarks($id)
    {
       return $this->mark->where('subject_id',$id)->paginate(8);

    }

    public function showFaculties() {
        return $this->faculty::all()->pluck('name','id');
    }

    public function query() {
        return $this->model->query();
    }

    public function getAllList()
    {
        return $this->model->with('faculty')->get();
    }

    public function paginate() {
        return $this->model->paginate(8);
    }

}
?>