<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctorProfile;

        $schedules = $doctor->schedules()
            ->orderByRaw("FIELD(day_of_week, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday')")
            ->orderBy('start_time')
            ->get();

        return view('doctor.schedules.index', compact('schedules'));
    }

    private function getUpcomingDays()
    {
        $days = [];
        $kurdishDays = [
            'monday' => 'دووشەممە',
            'tuesday' => 'سێشەممە',
            'wednesday' => 'چوارشەممە',
            'thursday' => 'پێنجشەممە',
            'friday' => 'هەینی',
            'saturday' => 'شەممە',
            'sunday' => 'یەکشەممە',
        ];

        // We show next 7 days starting from tomorrow if user wants a cutoff
        // The user said: "when it change from 31/1 to 1/2 day [to today] he not be able"
        // So we show the next 7 days, but maybe indicate which ones are valid.
        // Actually, let's just show next 7 days starting from tomorrow for better UX.
        for ($i = 1; $i <= 7; $i++) {
            $date = now()->addDays($i);
            $dayName = strtolower($date->format('l'));
            $days[] = [
                'name' => $dayName,
                'kurdish_name' => $kurdishDays[$dayName],
                'date' => $date->format('d/m'),
            ];
        }

        return $days;
    }

    public function create()
    {
        $upcomingDays = $this->getUpcomingDays();
        return view('doctor.schedules.create', compact('upcomingDays'));
    }

    public function store(Request $request)
    {
        $doctor = Auth::user()->doctorProfile;

        $request->validate([
            'day_of_week' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients' => 'required|integer|min:1|max:50',
        ]);

        // Cutoff validation: cannot add schedule for today
        if ($request->day_of_week === strtolower(now()->format('l'))) {
            return back()->withErrors(['error' => 'ناتوانیت خشتە بۆ ئەمڕۆ زیاد بکەیت. دەبێت پێش کاتژمێر ١٢ی شەو بێت بۆ ڕۆژی دواتر.'])->withInput();
        }

        // Check for duplicate
        $exists = $doctor->schedules()
            ->where('day_of_week', $request->day_of_week)
            ->where('start_time', $request->start_time)
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'ئەم خشتە کاتە پێشتر زیادکراوە'])->withInput();
        }

        $doctor->schedules()->create([
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_duration' => 30, // Default duration
            'max_patients' => $request->max_patients,
            'is_available' => true,
        ]);

        return redirect()->route('doctor.schedules.index')->with('success', 'خشتەی کات بە سەرکەوتوویی زیادکرا');
    }

    public function destroy($id)
    {
        $doctor = Auth::user()->doctorProfile;
        $schedule = $doctor->schedules()->findOrFail($id);

        $schedule->delete();

        return redirect()->route('doctor.schedules.index')->with('success', 'خشتەی کات سڕایەوە');
    }

    public function toggleAvailability($id)
    {
        $doctor = Auth::user()->doctorProfile;
        $schedule = $doctor->schedules()->findOrFail($id);

        $schedule->update([
            'is_available' => !$schedule->is_available
        ]);

        $status = $schedule->is_available ? 'چالاککرایەوە' : 'ناچالاککرایەوە';

        return redirect()->back()->with('success', "خشتەی کات {$status}");
    }
}