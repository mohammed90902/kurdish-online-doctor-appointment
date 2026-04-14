<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminManagementController extends Controller
{
    public function index()
    {
        // Get all admins except the currently logged-in one for safety
        $admins = User::where('role', 'admin')
            ->where('id', '!=', Auth::id())
            ->latest()
            ->paginate(10);

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'بەڕێوەبەری نوێ بە سەرکەوتوویی زیادکرا');
    }

    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        
        // Prevent self-deletion (extra safety check)
        if ($admin->id === Auth::id()) {
            return back()->with('error', 'ناتوانی هەژماری خۆت بسڕیتەوە');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'بەڕێوەبەر بە سەرکەوتوویی سڕایەوە');
    }
}
