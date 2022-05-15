<?php
namespace App\Repositories\ClassRepository;
use App\Models\ClassModel;
use App\Repositories\Base\BaseRepository;


class ClassRepository extends BaseRepository implements ClassRepositoryInterface {

    public function __construct(ClassModel $classModel){
        parent::__construct($classModel);

    }

    public function showStudents($id) {
        return $this->model->student->where('class_id',$id)->paginate(8);
    }

    public function getAllList()
    {
        return $this->model->with('faculty')->paginate(8);
    }
}
?>