<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkRequest;
use App\Repositories\ClassRepository\ClassRepository;
use App\Repositories\Mark\MarkRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Subject\SubjectRepository;
use Illuminate\Support\Facades\Gate;


class MarkController extends Controller
{
    protected $markRepository;
    protected $studentRepository;
    protected $classRepository;
    protected $subjectRepository;

    public function __construct(MarkRepository $markRepository, StudentRepository $studentRepository, ClassRepository $classRepository, SubjectRepository $subjectRepository)
    {
        $this->markRepository = $markRepository;
        $this->studentRepository = $studentRepository;
        $this->classRepository = $classRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $marks = $this->markRepository->getAllList();
        return view('marks.index', compact('marks'));
    }

    public function create()
    {
        $students = $this->studentRepository->getAllList()->pluck('name', 'id');

        $subject = $this->subjectRepository->getAllList()->pluck('name', 'id');

        $data = [];

        $data['students'] = $students;
        $data['subjects'] = $subject;
        return view('marks.create', compact('data'));
    }

    public function store(MarkRequest $request)
    {
        $request->validate([
            'mark' => 'required|numeric|between:0,10',
            'student_id' => 'required',
            'subject_id' => 'required',
        ]);
        $check = $this->markRepository->query()->where('student_id', $request->student_id)
            ->where('subject_id', $request->subject_id)->first();
        if (isset($check)) {
            $this->markRepository->update($check->id, $request->all());
        } else {
            $this->markRepository->store($request->all());
        }

        return redirect('students/' . $request->student_id)->with('success', 'Done !');
    }


    public function storeMore(MarkRequest $request)
    {
        $data = [];
        if (count($request->subject_id) > 0) {
            foreach ($request->subject_id as $item => $value) {
                array_push($data, [
                    'subject_id' => $request->subject_id[$item],
                    'mark' => $request->mark[$item],
                ]);
            }
        }
        $student = $this->studentRepository->getListById($request->student_id);

        $marks = [];
        foreach ($data as $key => $value) {
            $marks[$value['subject_id']] = ['mark' => $value['mark']];
        }
        $student->subjects()->sync($marks);

        return redirect('students/' . $request->student_id)->with('success', 'Done !');
    }

    public function edit($id)
    {
        $mark = $this->markRepository->getListById($id);
        $subjects = $this->subjectRepository->getAllList()->pluck('name', 'id');
        return view('marks.edit', compact('subjects','mark'));
    }

    public function update($id, MarkRequest $request)
    {

    }

    public function destroy($id)
    {
        if (Gate::allows('permission', 'admin')) {
            $this->markRepository->destroy($id);
            return back()->with('success', 'Delete mark successfully');
        }

        return back()->with('error', 'You can not delete this item');
    }

}
