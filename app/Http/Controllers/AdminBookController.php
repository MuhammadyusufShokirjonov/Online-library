<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'pdf'         => ['required', 'file', 'mimes:pdf', 'max:51200'], // Maksimal 50MB
            'cover'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'], // Maksimal 5MB
        ]);

        $fileKey = (string) Str::uuid();

        $pdfPath = $request->file('pdf')->storeAs('private/books', $fileKey . '.pdf');

        $pageCount = 32; 
        try {
            $pdfContent = file_get_contents($request->file('pdf')->getRealPath());
            $numPages = preg_match_all("/\/Page\W/", $pdfContent, $matches);
            if ($numPages > 0) {
                $pageCount = $numPages;
            }
        } catch (\Exception $e) {
            $pageCount = 32;
        }

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Book::create([
            'category_id'     => $validated['category_id'],
            'title'           => trim($validated['title']),
            'author'          => trim($validated['author']),
            'active_file_key' => $fileKey,
            'page_count'      => $pageCount,
            'cover_path'      => $coverPath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'pdf'         => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
            'cover'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $book->title = trim($validated['title']);
        $book->author = trim($validated['author']);
        $book->category_id = $validated['category_id'];

        if ($request->hasFile('pdf')) {
            $newFileKey = (string) Str::uuid();
            $request->file('pdf')->storeAs('private/books', $newFileKey . '.pdf');

            try {
                $pdfContent = file_get_contents($request->file('pdf')->getRealPath());
                $numPages = preg_match_all("/\/Page\W/", $pdfContent, $matches);
                if ($numPages > 0) {
                    $book->page_count = $numPages;
                }
            } catch (\Exception $e) {}

            $book->active_file_key = $newFileKey;
        }

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $book->cover_path = $request->file('cover')->store('covers', 'public');
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }
        $pdfPath = storage_path('app/private/books/' . $book->active_file_key . '.pdf');
        if (file_exists($pdfPath)) {
            @unlink($pdfPath);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}