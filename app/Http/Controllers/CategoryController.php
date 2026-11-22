<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        $editingCategory = null;
        if ($request->filled('edit')) {
            $editingCategory = Category::find($request->query('edit'));
        }

        return view('admin.categories.index', compact('categories', 'editingCategory'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ]);

        Category::create([
            'name' => trim($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
        ]);

        $category->update([
            'name' => trim($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category renamed successfully.');
    }

    public function destroy(Category $category)
    {
        $booksCount = $category->books()->count();

        if ($booksCount > 0) {
            return redirect()->route('admin.categories.index')->with(
                'error_blocked', 
                "{$category->name} contains {$booksCount} " . ($booksCount === 1 ? 'book' : 'books') . ". Reassign them before deleting this category."
            );
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}