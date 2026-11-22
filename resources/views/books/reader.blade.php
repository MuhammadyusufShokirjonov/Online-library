<x-layout.layout>
    <div class="max-w-4xl mx-auto py-2">

        <!-- 1. Orqaga qaytish havolasi -->
        <div class="mb-4">
            <a href="/books/{{ $book->id }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to book</span>
            </a>
        </div>

        <!-- 2. Kitob sarlavhasi va muallifi -->
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                {{ $book->title }}
            </h1>
            <p class="text-sm sm:text-base text-slate-500 font-medium">
                {{ $book->author }}
            </p>
        </div>

        <!-- 3. YAGONA ASOSIY KARTA (Varaqlash va Sahifa birgalikda — Mockup R05/R06) -->
        <div class="bg-slate-50/70 border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            
            <!-- Yuqori qism: Varaqlash paneli (Header) -->
            <div class="bg-white border-b border-slate-200 px-4 py-3 flex items-center justify-between">
                <!-- Previous -->
                @if ($page > 1)
                    <a href="/books/{{ $book->id }}/read?page={{ $page - 1 }}" class="btn btn-sm bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg shadow-sm gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        <span>Previous</span>
                    </a>
                @else
                    <button disabled class="btn btn-sm btn-disabled opacity-40 bg-slate-100 border border-slate-200 text-slate-400 font-semibold px-4 rounded-lg cursor-not-allowed gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        <span>Previous</span>
                    </button>
                @endif

                <!-- Page X of Y -->
                <div class="text-sm font-bold text-slate-800 tracking-wide">
                    Page {{ $page }} of {{ $book->page_count }}
                </div>

                <!-- Next -->
                @if ($page < $book->page_count)
                    <a href="/books/{{ $book->id }}/read?page={{ $page + 1 }}" class="btn btn-sm bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg shadow-sm gap-1">
                        <span>Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @else
                    <button disabled class="btn btn-sm btn-disabled opacity-40 bg-slate-100 border border-slate-200 text-slate-400 font-semibold px-4 rounded-lg cursor-not-allowed gap-1">
                        <span>Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </button>
                @endif
            </div>

            <!-- Pastki qism: Och fon va o'rtadagi alohida oq varaq (Mockup R05) -->
            <div class="p-4 sm:p-8 md:p-0 flex justify-center items-center min-h-[560px]">
                
                @if(request()->has('error'))
                    <!-- MOCKUP R07: Xatolik holati -->
                    <div class="bg-white border border-slate-200 rounded-xl p-8 max-w-sm w-full text-center shadow-sm">
                        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center border border-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">This page couldn’t load</h3>
                        <p class="text-sm text-slate-500 mb-6">Try loading page {{ $page }} again.</p>
                        <a href="{{ url()->current() }}?page={{ $page }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none font-semibold px-5 rounded-lg shadow-sm">
                            Retry page
                        </a>
                    </div>
                @else
                    <!-- MOCKUP R05 / R06: O'rtadagi OQ QOG'OZ (Kitob sahifasi) -->
                    <div class="bg-white border border-slate-200/80 rounded-xl shadow-md p-6 sm:p-10 max-w-lg w-full min-h-[500px] flex flex-col justify-between text-left">
                        
                        <!-- Sahifa tepasi: Kitob nomi va muallif -->
                        <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-3">
                            <span>{{ $book->title }}</span>
                            <span>{{ $book->author }}</span>
                        </div>

                        <!-- Sahifa kontenti (Rasm yoki matn) -->
                        <div class="my-auto py-8 text-center">
                            <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 mx-auto flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800 mb-2">Reading Page {{ $page }}</h2>
                            <p class="text-xs text-slate-400 max-w-xs mx-auto">
                                Reading pages are generated and served from the original PDF file.
                            </p>
                        </div>

                        <!-- Sahifa tagi: Nomi va raqami -->
                        <div class="flex items-center justify-between text-[11px] font-semibold text-slate-400 border-t border-slate-100 pt-3">
                            <span>{{ $book->category->name }}</span>
                            <span>{{ $page }}</span>
                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>
</x-layout.layout>