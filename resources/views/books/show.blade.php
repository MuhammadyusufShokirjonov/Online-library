<x-layout.layout>
    <div class="max-w-5xl mx-auto py-2">

        <!-- 1. Orqaga qaytish havolasi (Mockup R04: moviy rangda) -->
        <div class="mb-6">
            <a href="/"
                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to catalog</span>
            </a>

            @if (session('just_signed_in'))
                <!-- Mockup R10: Signed-in notice banner -->
                <div
                    class="mt-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium px-4 py-3 rounded-xl flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 flex-shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>You’re signed in. You can download the original PDF.</span>
                </div>
            @endif
        </div>

        <!-- 2. DESKTOPDA YONMA-YON, MOBILDA USTMA-UST BLOK -->
        <div class="flex flex-col md:flex-row items-start gap-8 lg:gap-12">

            <!-- Chap ustun: Kulrang fonli maydon va o'rtadagi kitob muqovasi (Mockup R04) -->
            <div class="w-full md:w-[340px] lg:w-[380px] flex-shrink-0">
                <div
                    class="w-full bg-slate-100/70 border border-slate-200/50 rounded-2xl flex items-center justify-center p-6 sm:p-8 min-h-[360px] md:min-h-[420px]">
                    @if ($book->cover_path)
                        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}"
                            class="max-h-[300px] w-auto object-contain rounded shadow-lg border border-slate-200/40">
                    @else
                        <div
                            class="w-44 aspect-[3/4] bg-emerald-50 border border-emerald-100 rounded-xl flex flex-col items-center justify-center p-4 text-center shadow-md">
                            <span class="text-5xl mb-3">📖</span>
                            <span
                                class="text-xs font-semibold text-emerald-800 uppercase tracking-wider">{{ $book->category->name }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- O'ng ustun: Kitob ma'lumotlari va tugmalar -->
            <div class="flex-1 w-full flex flex-col pt-1">

                <!-- Kategoriya nishoni (Mockupdagi och kulrang badge) -->
                <div class="mb-3">
                    <span class="inline-block bg-slate-100 text-slate-700 font-medium text-xs px-3 py-1.5 rounded">
                        {{ $book->category->name }}
                    </span>
                </div>

                <!-- Kitob nomi va Muallifi -->
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">
                    {{ $book->title }}
                </h1>
                <p class="text-base sm:text-lg text-slate-500 font-medium mb-6">
                    by <span class="text-slate-800">{{ $book->author }}</span>
                </p>

                <!-- MOBILDA (md:hidden): "PDF · X pages" bitta ixcham qatorda (Mockup R04 Mobile) -->
                <div class="flex items-center gap-2 text-sm text-slate-700 md:hidden mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-bold">PDF</span>
                    <span class="text-slate-400">·</span>
                    <span class="font-medium text-slate-600">{{ $book->page_count }} pages</span>
                </div>

                <!-- DESKTOPDA (hidden md:block): Gorizontal chiziq va Format / Length ustunlari (Mockup R04 Desktop) -->
                <div class="hidden md:block border-t border-slate-200 pt-6 mb-8">
                    <div class="grid grid-cols-2 gap-10 max-w-xs">
                        <div>
                            <span
                                class="block text-xs uppercase tracking-wider text-slate-400 font-semibold mb-1">Format</span>
                            <span class="text-base font-bold text-slate-900">PDF</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs uppercase tracking-wider text-slate-400 font-semibold mb-1">Length</span>
                            <span class="text-base font-bold text-slate-900">{{ $book->page_count }} pages</span>
                        </div>
                    </div>
                </div>

                <!-- Tugmalar qatori -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

                    <!-- Read online -->
                    <a href="/books/{{ $book->id }}/read"
                        class="btn bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white border-none font-semibold px-6 rounded-lg shadow-sm gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Read online</span>
                    </a>

                    @auth
                        <!-- Download PDF -->
                        <a href="{{ route('books.download', $book) }}"
                            class="btn bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-5 rounded-lg shadow-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Download PDF</span>
                        </a>
                    @else
                        <!-- Sign in to download (Qulf belgisi bilan) -->
                        <a href="/login?book_id={{ $book->id }}"
                            class="btn bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-5 rounded-lg shadow-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span>Sign in to download</span>
                        </a>
                    @endauth

                </div>

            </div>

        </div>

    </div>
</x-layout.layout>
