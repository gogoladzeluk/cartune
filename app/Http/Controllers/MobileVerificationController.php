<?php

namespace App\Http\Controllers;

use App\Models\MobileVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MobileVerificationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function send(Request $request): JsonResponse
    {
        try {
            $this->validatorSend($request->all())->validate();
            MobileVerification::store($request->all());
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    protected function validatorSend(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'string', 'digits:9'],
        ]);
    }

    public function check(Request $request): JsonResponse
    {
        try {
            $this->validatorCheck($request->all())->validate();
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    protected function validatorCheck(array $data)
    {
        $expectedCode = MobileVerification::getCodeByMobile($data['mobile']);
        return Validator::make($data, [
            'mobile' => ['required', 'digits:9'],
            'code'   => ['required', 'string', Rule::in([$expectedCode, MobileVerification::getMasterKey()])],
        ]);
    }
}
