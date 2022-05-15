<?php

namespace App\Http\Requests;

use App\Models\ClassModel;
use App\Models\Student;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate = [
            'name' => 'required',
            'birthday' => 'required|date|date_format:Y-m-d|after:1-1-1990|before:31-12-2001',
            'gender' => 'required',
            'phone_number' => ['digits_between:9,11', 'numeric', 'required', 'min:0',
                Rule::unique('students')->ignore($this->student),
                ],
            'class_id' => 'required',
        ];

        if(count(ClassModel::all()) == 0) {
            $validate['class_id'] = '';
        }

        if($this->request->has('username')) {
            $validate = array_merge($validate,[
                'username' => 'required|string|max:50|unique:users',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'min:8|required_with:re_password|same:re_password',
                're_password' => 'min:8',
            ]);
        };
        if($this->student && $this->request->has('username')) {
            $student = Student::findOrFail($this->student);
            $user_id = $student->user->id;
            $validate['username'] = ['required', 'string', 'max:50',
                Rule::unique('users')->ignore($user_id)];
            $validate['email'] = ['required', 'string', 'email', 'max:100',
                Rule::unique('users')->ignore($user_id)];
        }

        if($this->request->has('student_id')) {
            $student_id = $this->request->all()['student_id'];
            $validate['phone_number'] = 'digits_between:9,11|numeric|required|min:0|unique:students,phone_number,'.$student_id;
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'class_id.required' => 'Please choose class'
        ];
    }
}
