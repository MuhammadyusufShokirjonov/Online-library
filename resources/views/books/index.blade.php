<x-layout.layout title="Book catalog">
    <!-- 1-BLOK: Sahifa sarlavhasi -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Book catalog</h1>
    </div>

    <!-- 2-BLOK: Qidiruv va Filter kartasi (Mobilda ramkasiz, Desktopda kartali) -->
    <div
        class="bg-transparent border-0 p-0 shadow-none md:bg-slate-50 md:border md:border-slate-200 md:rounded-xl md:p-6 md:shadow-sm mb-8 md:mb-10">
        <form action="/" method="GET" class="space-y-4 md:space-y-0 md:grid md:grid-cols-12 md:gap-4 md:items-end">

            <!-- 1. Title or author (Mobilda to'liq eni, Desktopda 6 ustun) -->
            <div class="md:col-span-6">
                <label for="search" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Title or author
                </label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" id="search"
                        placeholder="Search books"
                        class="input input-bordered w-full pl-10 bg-white border-slate-300 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none rounded-lg">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 2. Mobilda Category va Search TUGMASI YONMA-YON turadi (Desktopda esa alohida ustunlar) -->
            <div class="flex items-end gap-3 md:contents">

                <!-- Category select (Mobilda kengayadi, Desktopda 4 ustun) -->
                <div class="flex-1 md:col-span-4">
                    <label for="category" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Category
                    </label>
                    <select name="category" id="category"
                        class="select select-bordered w-full bg-white border-slate-300 text-slate-700 focus:border-blue-600 focus:outline-none rounded-lg font-normal">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search tugmasi (Mobilda Category bilan yonma-yon, Desktopda 2 ustun) -->
                <div class="flex-shrink-0 md:col-span-2">
                    <button type="submit"
                        class="btn bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white border-none gap-2 rounded-lg font-semibold shadow-sm px-5 h-[42px] min-h-[42px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Search</span>
                    </button>
                </div>

            </div>

        </form>
    </div>

    <!-- 3-BLOK: Kitoblar ro'yxati -->
    <div>
        <!-- Sarlavha va soni -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-slate-900">
                {{ request()->filled('search') || request()->filled('category') ? 'Search results' : 'All books' }}
            </h2>
            <span class="text-sm text-slate-500 font-medium">
                {{ $books->count() }} {{ Str::plural('book', $books->count()) }}
            </span>
        </div>

        @if ($books->isEmpty())
            <!-- BO'SH HOLAT (Mockup R03: Lupa ikonkasi bilan) -->
            <div class="bg-white border border-slate-200 rounded-xl p-12 text-center shadow-sm">
                <!-- Lupa ikonkasi bloki -->
                <div
                    class="w-12 h-12 mx-auto mb-4 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">No books found</h3>
                <p class="text-sm text-slate-500 mb-6">
                    @if (request('search') && request('category'))
                        No books match "{{ request('search') }}" in this category.
                    @elseif(request('search'))
                        No books match "{{ request('search') }}".
                    @else
                        No books found in this category.
                    @endif
                </p>
                <div>
                    <a href="/"
                        class="btn btn-sm bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg shadow-sm">
                        Clear filters
                    </a>
                </div>
            </div>
        @else
            <!-- KITOBLAR RO'YXATI (Mockup R01: Oq karta, bo'lingan chiziqlar) -->
            <div
                class="bg-white border border-slate-200 rounded-xl divide-y divide-slate-100 shadow-sm overflow-hidden">
                @foreach ($books as $book)
                    <a href="/books/{{ $book->id }}"
                        class="flex items-center justify-between p-4 sm:p-5 hover:bg-slate-50 transition group">
                        <div class="flex items-center gap-4">
                            @if ($book->cover_path)
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}"
                                    class="w-12 h-16 object-cover rounded-lg">
                            @else
                                <div
                                    class="w-12 h-12 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-base font-semibold text-slate-900 group-hover:text-blue-600 transition">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-sm text-slate-500">{{ $book->author }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 sm:gap-6">
                            <span
                                class="badge bg-slate-100 text-slate-700 border-none font-medium text-xs px-3 py-2.5 rounded-full mr-20">
                                {{ $book->category->name }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Qidiruv natijasi chiqqanda pastda Clear filters (R02 mockup) -->
            @if (request()->filled('search') || request()->filled('category'))
                <div class="mt-4">
                    <a href="/"
                        class="inline-flex items-center text-sm font-semibold text-blue-600 hover:underline">
                        Clear filters
                    </a>
                </div>
            @endif
        @endif
    </div>
</x-layout.layout>
