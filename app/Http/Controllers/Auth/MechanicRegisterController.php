<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\MobileVerification;
use App\Models\Service;
use App\Models\Town;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MechanicRegisterController extends Controller
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
//            'code'            => ['required', 'string', Rule::in([$expectedCode])],
            'profile_picture' => ['required', 'image', 'max:20000'],
            'garage_picture'  => ['required', 'image', 'max:20000'],
            'town_id'         => ['required', Rule::exists('towns', 'id')],
            'district_id'     => ['required', Rule::exists('districts', 'id')],
            'address'         => ['required', 'string', 'max:255'],
            'service_ids'     => ['array'],
            'service_ids.*'   => [Rule::exists('services', 'id')],
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
        $garagePictureName = sprintf('%s-%s', time(), $data['garage_picture']->getClientOriginalName());
        $data['garage_picture']->move(public_path('images'), $garagePictureName);

        /** @var User $user */
        $user = User::create([
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'mobile'          => $data['mobile'],
            'profile_picture' => $profilePictureName,
            'garage_picture'  => $garagePictureName,
            'town_id'         => $data['town_id'],
            'district_id'     => $data['district_id'],
            'address'         => $data['address'],
            'password'        => Hash::make($data['password']),
            'type'            => User::TYPE_MECHANIC,
        ]);

        $user->services()->attach($data['service_ids']);

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $towns = Town::orderBy('title')->get();
        $districts = District::orderBy('title')->get();
        $services = Service::orderBy('title')->get();

        return view('auth.register-mechanic', [
            'towns'     => $towns,
            'districts' => $districts,
            'services'  => $services,
        ]);
    }
}
