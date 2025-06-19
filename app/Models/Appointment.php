<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'available_slot_id',
        'description',
        'first_name',
        'last_name',
        'second_last_name',
        'email',
        'phone_number',
        'residence_region_id',
        'residence_commune_id',
        'incident_region_id',
        'incident_commune_id',
        'questionnaire_response_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function slot()
    {
        return $this->belongsTo(AvailableSlot::class, 'available_slot_id');
    }
}
