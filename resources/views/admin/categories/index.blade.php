<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories — Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900 min-h-screen antialiased">
    
    <!-- Admin Navbar -->
    <x-layout.admin-nav />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
        
        <!-- Sarlavha -->
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Categories</h1>
        </div>

        <!-- MOCKUP A10: Agar o'chirish bloklansa, ogohlantirish banneri -->
        @if (session('error_blocked'))
            <div class="mb-6 bg-amber-50 border border-amber-200 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-sm font-semibold text-amber-900">{{ session('error_blocked') }}</span>
                </div>
                <a href="/admin/books" class="btn btn-sm bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg shadow-sm">
                    Manage books
                </a>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium px-4 py-3 rounded-xl flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- ASOSIY QISM: Mobilda Form birinchi (tepada), Jadval esa pastda chiqadi -->
        <div class="flex flex-col lg:grid lg:grid-cols-12 gap-8 items-start">
            
            <!-- 1. FORMA (Add category / Rename): Mobilda tepada (order-1), Desktopda o'ngda (lg:order-2) -->
            <div class="order-1 lg:order-2 w-full lg:col-span-4">
                
                @if ($editingCategory)
                    <!-- MOCKUP A09: Rename Category Card -->
                    <div class="bg-slate-50/80 border border-blue-200 rounded-xl p-5 sm:p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Rename category</h3>
                        <p class="text-xs text-slate-500 mb-4">Saving changes updates the label for all assigned books.</p>

                        <form action="{{ route('admin.categories.update', $editingCategory) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">Category name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name', $editingCategory->name) }}" 
                                    required 
                                    class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg text-sm"
                                >
                                @error('name')
                                    <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center gap-2 pt-1">
                                <button type="submit" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none font-semibold px-4 rounded-lg shadow-sm">
                                    Save changes
                                </button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- MOCKUP A08: Add Category Card (Och kulrang fon bilan) -->
                    <div class="bg-slate-50/80 border border-slate-200/80 rounded-xl p-5 sm:p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Add category</h3>

                        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">Category name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name') }}" 
                                    placeholder="Enter a unique name" 
                                    required 
                                    class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg text-sm"
                                >
                                @error('name')
                                    <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="pt-1">
                                <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white border-none font-semibold px-5 rounded-lg shadow-sm text-sm">
                                    Add category
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

            </div>

            <!-- 2. JADVAL: Mobilda pastda (order-2), Desktopda chapda (lg:order-1) -->
            <div class="order-2 lg:order-1 w-full lg:col-span-8">
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <table class="table w-full">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold">
                            <tr>
                                <th class="py-3 px-4 sm:px-6 text-left">Category</th>
                                <!-- Books sarlavhasi faqat desktopda chiqadi, mobilda yashirinadi -->
                                <th class="hidden sm:table-cell py-3 px-6 text-left">Books</th>
                                <th class="py-3 px-4 sm:px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <!-- Kategoriya nomi: Desktopda faqat nom, Mobilda esa ostida kitoblar soni ham chiqadi -->
                                    <td class="py-3.5 px-4 sm:px-6">
                                        <div class="font-bold text-slate-900 text-sm sm:text-base leading-snug">
                                            {{ $category->name }}
                                        </div>
                                        <!-- Mobilda ko'rinadigan kitoblar soni (Mockup A08 Mobile bo'yicha) -->
                                        <div class="sm:hidden text-xs text-slate-500 font-normal mt-0.5">
                                            {{ $category->books_count }} {{ Str::plural('book', $category->books_count) }}
                                        </div>
                                    </td>

                                    <!-- Books ustuni: Faqat Desktopda oddiy raqam sifatida chiqadi -->
                                    <td class="hidden sm:table-cell py-3.5 px-6 text-slate-700 font-medium">
                                        {{ $category->books_count }}
                                    </td>

                                    <!-- Harakatlar: Desktopda ikonkalar bilan, Mobilda esa ixcham matn -->
                                    <td class="py-3.5 px-4 sm:px-6 text-right">
                                        <div class="flex items-center justify-end gap-3 sm:gap-4">
                                            <!-- Rename tugmasi -->
                                            <a href="{{ route('admin.categories.index', ['edit' => $category->id]) }}" 
                                                class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="hidden sm:block w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                <span>Rename</span>
                                            </a>

                                            <!-- Delete tugmasi -->
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800 transition inline-flex items-center gap-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="hidden sm:block w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>
</body>
</html>