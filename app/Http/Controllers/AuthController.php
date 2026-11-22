<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Login sahifasini ko'rsatish (Mockup R08 va R11)
    public function createLogin(Request $request)
    {
        $selectedBook = null;
        if ($request->filled('book_id')) {
            $selectedBook = Book::with('category')->find($request->query('book_id'));
        }

        return view('auth.login', compact('selectedBook'));
    }

    // 2. Login qilish jarayoni
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/statistics');
            }
            if ($request->filled('book_id')) {
                return redirect('/books/' . $request->input('book_id'))->with('just_signed_in', true);
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function createRegister(Request $request)
    {
        $selectedBook = null;
        if ($request->filled('book_id')) {
            $selectedBook = Book::with('category')->find($request->query('book_id'));
        }

        return view('auth.register', compact('selectedBook'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'reader', // Talab bo'yicha ommaviy ro'yxatdan o'tish faqat reader yaratadi
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        if ($request->filled('book_id')) {
            return redirect('/books/' . $request->input('book_id'))->with('just_signed_in', true);
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
