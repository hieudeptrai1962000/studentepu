<?php
namespace App\Repositories\Faculty;
use App\Repositories\Base\BaseRepositoryInterface;

interface FacultyRepositoryInterface extends BaseRepositoryInterface{
    public function showClasses($id);
}
?>

