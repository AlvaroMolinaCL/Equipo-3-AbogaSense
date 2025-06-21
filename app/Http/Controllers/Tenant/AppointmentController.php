<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('tenants.default.appointments.index');
    }

    public function show($id)
    {
        $appointment = Appointment::with('availableSlot')->findOrFail($id);

        return view('tenants.default.appointments.show', compact('appointment'));
    }
}