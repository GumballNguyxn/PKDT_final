<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'name.required'=>'Vui lòng nhập họ tên.',
            'name.string'=>'Họ tên không được là một dãy số.',
            'name.max'=>'Họ tên không quá 255 ký tự.',
            'email.required'=>'Vui lòng nhập email.',
            'email.string'=>'Email chứa ký tự không hợp lệ.',
            'email.email'=>'Email không hợp lệ.',
            'email.max'=>'Email không quá 255 ký tự.',
            'password.required'=>'Vui lòng nhập password.',
            'password.min'=>'Mật khẩu phải ít nhất 8 ký tự.',
            'password.confirmed'=>'Xác nhận mật khẩu không khớp.',
            'password.string'=>'Mật khẩu chứa ký tự không hợp lệ.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
