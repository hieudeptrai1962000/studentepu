<?php
namespace App\Repositories\Faculty;
use App\Models\ClassModel;
use App\Models\Faculty;
use App\Repositories\Base\BaseRepository;
class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface {
    protected $classModel;
    public function __construct(Faculty $faculty, ClassModel $classModel){
        parent::__construct($faculty);
        $this->classModel = $classModel;
    }

    public function showClasses($id) {
        return $this->classModel->where('faculty_id',$id)->paginate(8);
    }
}
?>