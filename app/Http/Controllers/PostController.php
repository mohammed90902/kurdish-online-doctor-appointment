<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title_ku' => 'required|string|max:255',
            'content_ku' => 'required|string',
            'title_ar' => 'nullable|string|max:255',
            'content_ar' => 'nullable|string',
            'title_en' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'title_ku', 'title_ar', 'title_en', 
            'content_ku', 'content_ar', 'content_en'
        ]);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        Post::create($data);

        $route = Auth::user()->isAdmin() ? 'admin.posts.index' : 'doctor.posts.index';
        return redirect()->route($route)->with('success', 'پۆستەکە بە سەرکەوتوویی بڵاوکرایەوە.');
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.posts.create');
        }
        return view('doctor.posts.create');
    }

    public function show($id)
    {
        $post = Post::with('user.doctorProfile')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Only author or admin can delete
        if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('success', 'پۆستەکە سڕایەوە.');
    }
}
