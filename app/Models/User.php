<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'name_ku',
        'name_ar',
        'name_en',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function patientProfile()
    {
        return $this->hasOne(PatientProfile::class);
    }

    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class);
    }

    public function appointmentHistoryChanges()
    {
        return $this->hasMany(AppointmentHistory::class, 'changed_by');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function isPatient()
    {
        return $this->role === 'patient';
    }

    public function getLocalizedNameAttribute(): string
    {
        $locale = \Illuminate\Support\Facades\App::getLocale();
        $colLang = $locale === 'ckb' ? 'ku' : (in_array($locale, ['ar', 'en']) ? $locale : 'ku');
        $column = "name_{$colLang}";
        
        return $this->{$column} 
            ?? $this->name 
            ?? $this->name_ku 
            ?? $this->name_ar 
            ?? $this->name_en 
            ?? '';
    }
}