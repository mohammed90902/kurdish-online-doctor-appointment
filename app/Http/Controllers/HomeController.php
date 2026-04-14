<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\DoctorProfile;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $specializations = Specialization::withCount('doctors')->inRandomOrder()->take(6)->get();
        $featuredDoctors = DoctorProfile::approved()
            ->with(['user', 'specialization'])
            ->inRandomOrder()
            ->take(6)
            ->get();
        
        $stats = [
            'total_doctors' => DoctorProfile::approved()->count(),
            'total_specializations' => Specialization::count(),
        ];

        $posts = \App\Models\Post::with('user.doctorProfile')
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('specializations', 'featuredDoctors', 'stats', 'posts'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database only
        Contact::create($validated);

        return back()->with('success', 'پەیامەکەت بە سەرکەوتوویی نێردرا! زۆر سوپاس.');
    }

    public function specialty($id)
    {
        $specialization = Specialization::with(['doctors.user'])->findOrFail($id);
        return view('specialty-show', compact('specialization'));
    }

    public function allSpecialties()
    {
        $specializations = Specialization::withCount('doctors')->get();
        return view('specialties.index', compact('specializations'));
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $query = trim($request->get('q', ''));

        if (empty($query)) {
            return redirect()->route('home');
        }

        // Search doctors (by user name, specialization names, and translated bio/qualifications)
        $doctors = \App\Models\DoctorProfile::approved()
            ->with(['user', 'specialization'])
            ->where(function($q) use ($query) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$query}%")
                    ->orWhere('name_ku', 'like', "%{$query}%")
                    ->orWhere('name_ar', 'like', "%{$query}%")
                    ->orWhere('name_en', 'like', "%{$query}%")
                )
                  ->orWhereHas('specialization', fn($s) => $s->where('name_ku', 'like', "%{$query}%")
                      ->orWhere('name_ar', 'like', "%{$query}%")
                      ->orWhere('name_en', 'like', "%{$query}%"))
                  ->orWhere('bio_ku', 'like', "%{$query}%")
                  ->orWhere('bio_ar', 'like', "%{$query}%")
                  ->orWhere('bio_en', 'like', "%{$query}%")
                  ->orWhere('qualifications', 'like', "%{$query}%");
            })
            ->take(10)
            ->get();

        // Search specializations using actual DB column names
        $specializations = \App\Models\Specialization::withCount('doctors')
            ->where(function($q) use ($query) {
                $q->where('name_ku', 'like', "%{$query}%")
                  ->orWhere('name_ar', 'like', "%{$query}%")
                  ->orWhere('name_en', 'like', "%{$query}%")
                  ->orWhere('description_ku', 'like', "%{$query}%");
            })
            ->take(6)
            ->get();

        // Search posts
        $posts = \App\Models\Post::with('user.doctorProfile')
            ->where('is_published', true)
            ->where(function($q) use ($query) {
                $q->where('title_ku', 'like', "%{$query}%")
                  ->orWhere('title_ar', 'like', "%{$query}%")
                  ->orWhere('title_en', 'like', "%{$query}%")
                  ->orWhere('content_ku', 'like', "%{$query}%")
                  ->orWhere('content_ar', 'like', "%{$query}%")
                  ->orWhere('content_en', 'like', "%{$query}%");
            })
            ->latest()
            ->take(6)
            ->get();

        return view('search-results', compact('query', 'doctors', 'specializations', 'posts'));
    }

    public function healthAdvice()
    {
        $posts = \App\Models\Post::with('user.doctorProfile')
            ->latest()
            ->paginate(12);

        return view('posts.all', compact('posts'));
    }
}