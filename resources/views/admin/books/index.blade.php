<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books — Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900 min-h-screen antialiased">
    
    <x-layout.admin-nav />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
        
        <!-- Sarlavha va "Add book" tugmasi (Mockup A03) -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Books</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">{{ $books->count() }} {{ Str::plural('book', $books->count()) }}</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none font-semibold px-4 rounded-lg shadow-sm gap-1.5 sm:gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add book</span>
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium px-4 py-3 rounded-xl flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- 1. DESKTOPDA: Jadval ko'rinishi (Mockup A03 Desktop) -->
        <div class="hidden sm:block bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <table class="table w-full">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold">
                    <tr>
                        <th class="py-3 px-6 text-left">Book</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($books as $book)
                        <tr class="hover:bg-slate-50/50 transition">
                            <!-- Kitob rasmi, nomi va muallifi -->
                            <td class="py-3.5 px-6">
                                <div class="flex items-center gap-3.5">
                                    @if ($book->cover_path)
                                        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}"
                                            class="w-10 h-14 object-cover rounded shadow-sm border border-slate-200/60 flex-shrink-0">
                                    @else
                                        <!-- Agar muqova bo'lmasa: Mockupdagi "Field Notes" kabi kulrang quti -->
                                        <div class="w-10 h-14 bg-slate-100 border border-slate-200 rounded flex items-center justify-center text-slate-400 flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-slate-900 text-base leading-snug">{{ $book->title }}</div>
                                        <div class="text-xs text-slate-500 font-medium mt-0.5">{{ $book->author }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategoriya nishoni -->
                            <td class="py-3.5 px-6">
                                <span class="badge bg-slate-100 text-slate-700 border-none font-medium text-xs px-2.5 py-1">
                                    {{ $book->category->name }}
                                </span>
                            </td>

                            <!-- Harakatlar: Ikonkali Edit & Delete -->
                            <td class="py-3.5 px-6 text-right">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition inline-flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        <span>Edit</span>
                                    </a>

                                    <button onclick="document.getElementById('delete_modal_{{ $book->id }}').showModal()" class="text-xs font-semibold text-rose-600 hover:text-rose-800 transition inline-flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-400 text-sm">
                                No books yet. Click "Add book" to upload your first book.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 2. MOBILDA: Jadvalsiz, alohida chiroyli kartochkalar ro'yxati (Mockup A03 Mobile) -->
        <div class="sm:hidden space-y-3">
            @forelse ($books as $book)
                <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm flex flex-col gap-3">
                    <!-- Yuqori qism: Rasm + Nom/Muallif va Kategoriya -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3">
                            @if ($book->cover_path)
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}"
                                    class="w-11 h-14 object-cover rounded shadow-sm border border-slate-200/60 flex-shrink-0">
                            @else
                                <div class="w-11 h-14 bg-slate-100 border border-slate-200 rounded flex items-center justify-center text-slate-400 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-bold text-slate-900 text-sm leading-snug">{{ $book->title }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $book->author }}</p>
                            </div>
                        </div>

                        <!-- Kategoriya nishoni o'ng burchakda -->
                        <span class="badge bg-slate-100 text-slate-700 border-none font-medium text-xs px-2.5 py-1 flex-shrink-0">
                            {{ $book->category->name }}
                        </span>
                    </div>

                    <!-- Pastki qism: Matn ostida turuvchi Edit va Delete tugmalari -->
                    <div class="flex items-center gap-4 pl-14">
                        <a href="{{ route('admin.books.edit', $book) }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition inline-flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <span>Edit</span>
                        </a>

                        <button onclick="document.getElementById('delete_modal_{{ $book->id }}').showModal()" class="text-xs font-semibold text-rose-600 hover:text-rose-800 transition inline-flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="bg-white border border-slate-200 rounded-xl p-8 text-center text-slate-400 text-sm">
                    No books yet. Click "Add book" to upload your first book.
                </div>
            @endforelse
        </div>

        <!-- O'chirishni tasdiqlash dialoglari (Ham desktop, ham mobil uchun) -->
        @foreach ($books as $book)
            <dialog id="delete_modal_{{ $book->id }}" class="modal text-left">
                <div class="modal-box bg-white max-w-md p-6 rounded-2xl border border-slate-200 shadow-xl">
                    <h3 class="font-extrabold text-lg text-slate-900 mb-2">Delete {{ $book->title }}?</h3>
                    <p class="text-sm text-slate-500 mb-6">
                        The book and its activity will be removed from the catalog and rankings. Its reading and download links will stop working.
                    </p>
                    <div class="flex items-center justify-end gap-3">
                        <form method="dialog">
                            <button class="btn btn-sm bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg">
                                Cancel
                            </button>
                        </form>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-rose-600 hover:bg-rose-700 text-white border-none font-semibold px-4 rounded-lg">
                                Delete book
                            </button>
                        </form>
                    </div>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>
        @endforeach

    </main>
</body>
</html>