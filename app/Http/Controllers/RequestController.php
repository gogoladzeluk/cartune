<?php

namespace App\Http\Controllers;

use App\Models\MobileVerification;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store(HttpRequest $httpRequest)
    {
        try {
            $this->validator($httpRequest->all())->validate();
            /** @var Request $request */
            $request = Request::create($httpRequest->all());
            $request->sendDiscordMessage();
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    protected function validator(array $data)
    {
        $expectedCode = isset($data['mobile'])
            ? MobileVerification::getCodeByMobile($data['mobile'])
            : null;
        return Validator::make($data, [
            'name'   => ['required'],
            'mobile' => ['required', 'digits:9'],
            'code'   => ['required', 'string', Rule::in([$expectedCode, MobileVerification::getMasterKey()])],
            'text'   => ['required', 'string'],
        ]);
    }
}
