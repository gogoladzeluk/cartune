<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MobileVerification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->update($request->all());

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(route('login'));
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
            'mobile'   => ['required', 'string', 'digits:9', Rule::exists('users', 'mobile')],
            'code'     => ['required', 'string', Rule::in([$expectedCode])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the reset password form.
     *
     * @return \Illuminate\View\View
     */
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    /**
     * @param array $all
     * @return User
     */
    private function update(array $data)
    {
        return User::where('mobile', $data['mobile'])
            ->first()
            ->update(['password' => Hash::make($data['password'])]);
    }
}
