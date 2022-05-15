<?php

namespace App\Http\Controllers;
use App\Http\Requests\FacultyRequest;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    public function index()
    {
        $faculties = $this->facultyRepository->paginate();
        return view('faculties.index',compact('faculties'));
    }

    public function create()
    {
        return view('faculties.create');
    }

    public function store(FacultyRequest $request)
    {
        $this->facultyRepository->store($request->all());
        return redirect($request->redirects_to)->with('success','Create faculty successfully !');
    }


    public function edit($id)
    {
      $faculty =  $this->facultyRepository->getListById($id);
      return view('faculties.edit',compact('faculty'));
    }

    public function update($id,FacultyRequest $request )
    {
        if($this->facultyRepository->getListById($id)->name == $request->name ) {
            return redirect('faculties')->with('info', 'Nothing was changed !');
        }

        else {
            $this->facultyRepository->update($id, $request->all());
            return redirect($request->redirects_to)->with('success', 'Update faculty successfully !');
        }
    }

    public function destroy($id)
    {
        if (Gate::allows('permission', 'admin')) {
            $this->facultyRepository->destroy($id);
            return back()->with('success', 'Delete faculty successfully !');
        }

        return back()->with('error', 'You can not delete this item');
    }

    public function show($id) {
        $faculty = $this->facultyRepository->getListById($id);
        $classes = $faculty->classRelations()->paginate();
        return view('faculties.showClasses',compact('classes'));
    }
}
