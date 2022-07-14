<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request, $type)
    {
        try {
            $this->validator($request->all())->validate();
            Tracking::create(array_merge($request->all(), ['type' => $type]));
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
        return Validator::make($data, [
            'token' => ['required'],
        ]);
    }
}
