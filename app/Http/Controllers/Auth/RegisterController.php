<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ProfilesController;
use App\User;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'fullname' => 'required',
            'dob' => 'required',
            'sexual' => 'required'
        ],[
            'email.required' => 'Vui lòng nhập e-mail',
            'email.max' => 'Lỗi chiều dài e-mail',
            'email.unique' => 'E-mail đã được đăng ký!',
            'password.required' => 'Vui lòng nhập vào mật khẩu',
            'password.min' => 'Độ dài mật khẩu phải trên 6 ký tự!',
            'password.confirmed' => 'Mật khẩu xác thực không khớp!',
            'fullname.required' => 'Họ tên không được để trống!',
            'dob.required' => 'Vui lòng chọn ngày/tháng/năm sinh!',
            'sexual.required' => 'Vui lòng chọn giới tính!'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userid = Controller::GUID();
        $token = md5(time());
        ProfilesController::profile_create($userid, $data);
        return User::create([
            'userid' => $userid,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => 0,
            'status' => 1,
            'token' => $token
        ]);
    }
}
