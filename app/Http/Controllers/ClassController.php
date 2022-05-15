<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClassRequest;
use App\Repositories\ClassRepository\ClassRepositoryInterface;
use App\Repositories\Faculty\FacultyRepository;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class ClassController extends Controller
{
    protected $classRepository;
    protected $facultyRepository;

    public function __construct(ClassRepositoryInterface $classRepository, FacultyRepositoryInterface $facultyRepository)
    {
        $this->classRepository = $classRepository;
        $this->facultyRepository = $facultyRepository;
    }

    public function index()
    {
        $classes = $this->classRepository->getAllList();
        return view('classes.index',compact('classes'));
    }

    public function create()
    {
        $faculties = $this->facultyRepository->getAllList()->pluck('name','id');
        return view('classes.create',compact('faculties'));
    }

    public function store(ClassRequest $request)
    {
        $this->classRepository->store($request->all());
        return redirect($request->redirects_to)->with('success','Create class successfully');
    }


    public function edit($id)
    {
        $class =  $this->classRepository->getListById($id);
        $faculties = $this->facultyRepository->getAllList()->pluck('name','id');
        return view('classes.edit',compact('class'),compact('faculties'));
    }


    public function update($id,ClassRequest $request )
    {
        if($this->classRepository->getListById($id)->name == $request->name
            && $this->classRepository->getListById($id)->faculty_id ==$request->faculty_id) {
            return redirect($request->redirects_to)->with('info', 'Nothing was changed !');
        }
        else {
        $this->classRepository->update($id,$request->all());
        return redirect($request->redirects_to)->with('success','Update class successfully');}
    }

    public function destroy($id)
    {
        if (Gate::allows('permission', 'admin')) {
            $this->classRepository->destroy($id);
            return back()->with('success', 'Delete class successfully');
        }

        return back()->with('error', 'You can not delete this item');
    }

    public function show($id){
       $class = $this->classRepository->getListById($id);
        $students = $class->students()->paginate(8);
        return view('classes.showStudents',compact('class','students'));
    }
}
