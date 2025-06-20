<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentApiController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('availableSlot')
            ->whereHas('availableSlot', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get()
            ->filter(fn($a) => $a->availableSlot) // prevenir si hay registros sin slot
            ->map(function ($appointment) {
                $slot = $appointment->availableSlot;

                return [
                    'title' => substr($slot->start_time, 0, 5) . ' - ' . substr($slot->end_time, 0, 5),
                    'start' => "{$slot->date}T{$slot->start_time}",
                    'end' => "{$slot->date}T{$slot->end_time}",
                    'backgroundColor' => '#198754', // Verde (Bootstrap)
                    'borderColor' => '#198754',
                    'textColor' => '#ffffff',
                ];
            })
            ->values(); // limpia claves si se filtró

        return response()->json($appointments);
    }
}