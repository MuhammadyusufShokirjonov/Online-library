<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Yuqori qator: Logo, Admin nishoni va O'ng tomon havolalari -->
        <div class="flex items-center justify-between h-16">
            <!-- Chap tomon: Logo + Admin Badge -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="/" class="flex items-center gap-2 sm:gap-2.5 flex-shrink-0">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 bg-blue-600 text-white rounded-lg flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-base sm:text-xl font-bold tracking-tight text-slate-900 whitespace-nowrap">Online Library</span>
                </a>
                <span class="bg-blue-50 text-blue-700 border border-blue-200 font-semibold text-xs px-2 py-0.5 rounded">
                    Admin
                </span>
            </div>

            <!-- O'ng tomon: Mobilda ixcham, Desktopda ikonkali to'liq -->
            <div class="flex items-center gap-3 sm:gap-6">
                <!-- MOBILDA (sm:hidden): "Catalog" va "Sign out" (sig'ishi uchun ikonkasiz) -->
                <div class="flex items-center gap-3 sm:hidden">
                    <a href="/" class="text-sm font-semibold text-blue-600 whitespace-nowrap">
                        Catalog
                    </a>
                    <form action="/logout" method="POST" class="inline m-0">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-slate-600 whitespace-nowrap">
                            Sign out
                        </button>
                    </form>
                </div>

                <!-- DESKTOPDA (hidden sm:flex): Ikonkali to'liq ko'rinish (Mockup bo'yicha) -->
                <div class="hidden sm:flex items-center gap-6">
                    <a href="/" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition flex items-center gap-1.5 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>View catalog</span>
                    </a>

                    <form action="/logout" method="POST" class="inline m-0">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-slate-600 hover:text-rose-600 transition flex items-center gap-1.5 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Sign out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pastki qator: Admin Tab Menulari (Statistics, Books, Categories) -->
        <div class="flex items-center gap-6 sm:gap-8 h-12 border-t border-slate-100">
            <a href="/admin/statistics" class="inline-flex items-center h-full px-1 text-sm font-medium {{ request()->is('admin/statistics*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                Statistics
            </a>
            <a href="/admin/books" class="inline-flex items-center h-full px-1 text-sm font-medium {{ request()->is('admin/books*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                Books
            </a>
            <a href="/admin/categories" class="inline-flex items-center h-full px-1 text-sm font-medium {{ request()->is('admin/categories*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                Categories
            </a>
        </div>

    </div>
</nav>