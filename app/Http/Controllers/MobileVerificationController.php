<?php

namespace App\Http\Controllers;

use App\Models\MobileVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobileVerificationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendCode(Request $request): JsonResponse
    {
        try {
            $this->validator($request->all())->validate();
            MobileVerification::create($request->all());
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'string', 'digits:9'],
        ]);
    }
}
