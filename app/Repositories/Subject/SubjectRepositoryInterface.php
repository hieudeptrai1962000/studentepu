<?php
namespace App\Repositories\Subject;
use App\Repositories\Base\BaseRepositoryInterface;

interface SubjectRepositoryInterface extends BaseRepositoryInterface{
    public function showFaculties();

    public function showMarks($id);
}
?>

