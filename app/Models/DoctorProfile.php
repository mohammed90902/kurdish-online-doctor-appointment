<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization_id',
        'license_number',
        'experience_years',
        'consultation_fee',
        'qualifications',
        'bio_ku',
        'bio_ar',
        'bio_en',
        'profile_image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'consultation_fee' => 'decimal:2',
            'experience_years' => 'integer',
        ];
    }

    public function getBioAttribute(): ?string
    {
        return $this->bio_ku ?? $this->bio_ar ?? $this->bio_en ?? null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isSuspended()
    {
        return $this->status === 'suspended';
    }

    public function getFullNameAttribute()
    {
        return $this->user->name;
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function getAvailableSlots($date)
    {
        $dayOfWeek = strtolower(date('l', strtotime($date)));
        
        $schedules = $this->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->get();

        $bookedSlots = $this->appointments()
            ->where('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('appointment_time')
            ->toArray();

        $availableSlots = [];
        
        foreach ($schedules as $schedule) {
            $slots = $schedule->generateTimeSlots();
            foreach ($slots as $slot) {
                if (!in_array($slot, $bookedSlots)) {
                    $availableSlots[] = $slot;
                }
            }
        }

        return $availableSlots;
    }
}