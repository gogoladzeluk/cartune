<?php

namespace App\Http\Controllers;

use App\Models\SmsOfficeDeliveryReport;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsOfficeDeliveryReportController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        SmsOfficeDeliveryReport::create($request->all());

        return response()->json();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'status'      => ['required', 'string'],
            'destination' => ['required', 'string'],
            'reference'   => ['nullable', 'string'],
            'reason'      => ['nullable', 'string'],
            'timestamp'   => ['nullable', 'string'],
            'operator'    => ['nullable', 'string'],
        ]);
    }
}
