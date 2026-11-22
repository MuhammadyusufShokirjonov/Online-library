<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\BookActivityEvent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->query('category'));
        }

        $books = $query->get();
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);

        if (!$book) {
            return response()->view('books.unavailable', [], 404);
        }

        return view('books.show', compact('book'));
    }

    public function read(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->view('books.unavailable', [], 404);
        }

        $sessionKey = $request->session()->get('reader_session_key');
        if (!$sessionKey) {
            $sessionKey = (string) Str::uuid();
            $request->session()->put('reader_session_key', $sessionKey);
        }

        BookActivityEvent::firstOrCreate(
            [
                'book_id'     => $book->id,
                'session_key' => $sessionKey,
                'event_type'  => 'read',
            ],
            [
                'user_id'     => Auth::id(),
                'occurred_at' => now(),
            ]
        );

        $page = (int) $request->query('page', 1);

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $book->page_count) {
            $page = $book->page_count;
        }

        return view('books.reader', compact('book', 'page'));
    }

    public function download(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->view('books.unavailable', [], 404);
        }

        // 1. Xavfsizlik: Faqat login bo'lganlar yuklay oladi
        if (!Auth::check()) {
            return redirect()->route('login', ['book_id' => $book->id]);
        }

        $sessionKey = $request->session()->get('reader_session_key');
        if (!$sessionKey) {
            $sessionKey = (string) Str::uuid();
            $request->session()->put('reader_session_key', $sessionKey);
        }

        BookActivityEvent::firstOrCreate(
            [
                'book_id'     => $book->id,
                'session_key' => $sessionKey,
                'event_type'  => 'download',
            ],
            [
                'user_id'     => Auth::id(),
                'occurred_at' => now(),
            ]
        );

        $filePath = storage_path('app/private/books/' . $book->active_file_key . '.pdf');

        if (file_exists($filePath)) {
            return response()->download($filePath, Str::slug($book->title) . '.pdf');
        }

        return back()->with('info', 'PDF file is being prepared.');
    }
}