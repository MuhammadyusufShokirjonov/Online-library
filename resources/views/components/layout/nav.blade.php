<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Chap tomon: Logo va Menyular -->
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-blue-600 text-white rounded-lg flex items-center justify-center shadow-sm">
                        <!-- Kitobcha (Book) SVG ikonkasi -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900">Online Library</span>
                </a>

                <!-- Catalog havolasi (Faol holatdagi ko'k chiziqcha bilan) -->
                <div class="hidden sm:flex items-center h-16 pt-1">
                    <a href="/"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-blue-600 text-sm font-semibold text-blue-600">
                        Catalog
                    </a>
                </div>
            </div>

            <!-- O'ng tomon: Login holatiga qarab o'zgaradi -->
            <div class="flex items-center gap-3">
                @auth
                    <!-- 1. AGAR FOYDALANUVCHI ADMIN BO'LSA: Admin panel tugmasi -->
                    @if (auth()->user()->role === 'admin')
                        <a href="/admin/statistics"
                            class="btn btn-sm bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 font-semibold px-3 rounded-lg shadow-sm gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            <span>Admin panel</span>
                        </a>
                    @endif
                    <!-- 2. Email va Sign out -->
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn btn-sm bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg shadow-sm">
                            Sign out
                        </button>
                    </form>
                @else
                    <!-- Mehmon bo'lsa: Sign in havolasi -->
                    <a href="/login"
                        class="btn btn-sm bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-4 rounded-lg shadow-sm">
                        Sign in
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>
