<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MobileVerification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRegisterController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $expectedCode = MobileVerification::getCodeByMobile($data['mobile']);
        return Validator::make($data, [
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'mobile'          => ['required', 'string', 'digits:9', 'unique:users'],
            'code'            => ['required', 'string', Rule::in([$expectedCode])],
            'profile_picture' => ['required', 'image'],
            'password'        => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $profilePictureName = sprintf('%s-%s', time(), $data['profile_picture']->getClientOriginalName());
        $data['profile_picture']->move(public_path('images'), $profilePictureName);

        /** @var User $user */
        $user = User::create([
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'mobile'          => $data['mobile'],
            'profile_picture' => $profilePictureName,
            'password'        => Hash::make($data['password']),
            'type'            => User::TYPE_USER,
        ]);

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register-user');
    }
}
