<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentApiController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');

        // Si viene un parámetro "date", mostramos detalles de ese día
        if ($date) {
            $appointments = Appointment::with('availableSlot')
                ->whereHas('availableSlot', function ($query) use ($date) {
                    $query->where('user_id', auth()->id())
                        ->where('date', $date);
                })
                ->get()
                ->filter(fn($a) => $a->availableSlot)
                ->map(function ($appointment) {
                    $slot = $appointment->availableSlot;

                    return [
                        'id'           => $appointment->id,
                        'start_time'   => substr($slot->start_time, 0, 5),
                        'end_time'     => substr($slot->end_time, 0, 5),
                        'client_name'  => "{$appointment->first_name} {$appointment->last_name} {$appointment->second_last_name}",
                    ];
                })
                ->values();

            return response()->json($appointments);
        }

        // Si no hay "date", devolvemos los eventos para el calendario
        $appointments = Appointment::with('availableSlot')
            ->whereHas('availableSlot', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get()
            ->filter(fn($a) => $a->availableSlot)
            ->map(function ($appointment) {
                $slot = $appointment->availableSlot;

                return [
                    'title' => substr($slot->start_time, 0, 5) . ' - ' . substr($slot->end_time, 0, 5),
                    'start' => "{$slot->date}T{$slot->start_time}",
                    'end' => "{$slot->date}T{$slot->end_time}",
                    'backgroundColor' => '#198754',
                    'borderColor' => '#198754',
                    'textColor' => '#ffffff',
                ];
            })
            ->values();

        return response()->json($appointments);
    }
}