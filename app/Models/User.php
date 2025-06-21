<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'second_last_name',
        'email',
        'password',
        'phone_number',
        'genre_id',
        'birth_date',
        'residence_region_id',
        'residence_commune_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function files()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    public function sharedFiles()
    {
        return File::whereJsonContains('shared_with', $this->id)->get();
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPasswordMail($token, $this->email));
    }

    public function setPhoneNumberAttribute($value)
    {
        $phone = preg_replace('/\D/', '', $value);

        if (strlen($phone) === 9 && $phone[0] === '9') {
            $phone = '56' . $phone;
        } elseif (strlen($phone) === 11 && substr($phone, 0, 2) === '56') {
            // Se mantiene el número tal cual si ya tiene el prefijo
        }

        $this->attributes['phone_number'] = $phone;
    }

    public function getPhoneNumberForFormAttribute()
    {
        return preg_replace('/^56/', '', $this->phone_number ?? '');
    }
}
