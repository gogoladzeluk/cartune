<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $mechanics = User::getActiveMechanicsByServiceIds($request->query('services') ?? []);
        $districts = District::orderBy('title')->get();
        $services = Service::orderBy('title')->get();

        return view('mechanics.index', [
            'mechanics' => $mechanics,
            'districts' => $districts,
            'services' => $services,
        ]);
    }

    public function show($id)
    {
        $mechanic = User::getActiveMechanicById($id);
        return view('mechanics.show', ['mechanic' => $mechanic]);
    }
}
