<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\StudentRequest;
use App\Repositories\ClassRepository\ClassRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    protected $studentRepository;
    protected $classRepository;
    protected $userRepository;

    public function __construct(UserRepository $userRepository, StudentRepository $studentRepository, ClassRepository $classRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->classRepository = $classRepository;
        $this->userRepository = $userRepository;
        $this->middleware('guest');
    }

    use RegistersUsers;

    public function showRegistrationForm()
    {
        $classes = $this->classRepository->getAllList()->pluck('name', 'id');
        return view('students.create', compact('classes'));
    }

    public function register(StudentRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['re_password'] = Hash::make($request->re_password);
        DB::beginTransaction();
        try {
            $user = $this->userRepository->store($data);
            if ($request->hasFile('avatar')) {

                $file = upload_image('avatar');
                if (isset($file['name'])) {
                    $data['avatar'] = $file['name'];
                }
            }
            $data['user_id'] = $user->id;
            $this->studentRepository->store($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());

        }
        return view('students.login');
    }
}
