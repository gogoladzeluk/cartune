<?php

namespace App\Http\Controllers;

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
        $services = $request->query('services') ?? [];
        $mechanics = User::getActiveMechanicsByServiceIds($services);
        return $mechanics;
    }

    public function show($id)
    {
        $mechanic = User::getActiveMechanicById($id);
        return $mechanic;
    }
}
