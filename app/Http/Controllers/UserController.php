<?php

namespace App\Http\Controllers;
use App\Http\Requests\RequestPassword;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    use AuthenticatesUsers;

    public function updatePassword() {
        return view ('students.resetPassword');
    }

    public function saveUpdatePassword (RequestPassword $request) {

        if(Hash::check($request->old_password, Auth::user()->password )) {

            $user = $this->userRepository->getListById(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('students/'.$user->student->id.'/edit')
                ->with('success','Password has been changed !');
        }

        return redirect()->back()->with('error','Old password is not correct !');
    }

    public function getFormReset () {
        return view('students.forgotPassword');
    }
}
