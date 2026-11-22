<x-layout.layout>
    <div class="max-w-4xl mx-auto py-2">

        <!-- Orqaga qaytish havolasi -->
        <div class="mb-6">
            @if ($selectedBook)
                <a href="/books/{{ $selectedBook->id }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to book</span>
                </a>
            @else
                <a href="/"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to catalog</span>
                </a>
            @endif
        </div>

        <!-- ASOSIY BLOK: 2 ustunli ko'rinish -->
        <div class="{{ $selectedBook ? 'flex flex-col md:flex-row items-start gap-10 lg:gap-16' : 'max-w-md mx-auto' }}">

            @if ($selectedBook)
                <!-- Chap ustun: Selected book kartochkasi -->
                <div class="w-full md:w-[280px] flex-shrink-0 bg-slate-50/80 border border-slate-200/60 rounded-2xl p-6">
                    <span class="block text-xs uppercase tracking-wider text-slate-400 font-bold mb-4">
                        Selected book
                    </span>

                    <div class="flex justify-center mb-4">
                        @if ($selectedBook->cover_path)
                            <img src="{{ asset('storage/' . $selectedBook->cover_path) }}" alt="{{ $selectedBook->title }}"
                                class="max-h-[170px] w-auto object-contain rounded shadow-md border border-slate-200/50">
                        @else
                            <div class="w-28 aspect-[3/4] bg-emerald-50 border border-emerald-100 rounded-lg flex flex-col items-center justify-center p-2 text-center shadow-sm">
                                <span class="text-3xl mb-1">📖</span>
                            </div>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 leading-snug mb-1">
                        {{ $selectedBook->title }}
                    </h3>
                    <p class="text-sm text-slate-500 font-medium mb-3">
                        {{ $selectedBook->author }}
                    </p>
                    <span class="inline-block bg-slate-100 text-slate-700 text-xs font-semibold px-2.5 py-1 rounded">
                        {{ $selectedBook->category->name }}
                    </span>
                </div>
            @endif

            <!-- O'ng ustun: Ro'yxatdan o'tish formasi -->
            <div class="flex-1 w-full max-w-md">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Create reader account</h1>
                <p class="text-sm text-slate-500 mb-6">
                    @if ($selectedBook)
                        Create an account to download {{ $selectedBook->title }}.
                    @else
                        Create your library account to download books.
                    @endif
                </p>

                <form action="/register" method="POST" class="space-y-4">
                    @csrf

                    @if ($selectedBook)
                        <input type="hidden" name="book_id" value="{{ $selectedBook->id }}">
                    @endif

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="name@example.com" required
                            class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg">
                        @error('email')
                            <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" placeholder="Choose a password" required
                            class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg">
                        @error('password')
                            <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Enter the password again" required
                            class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="btn bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white border-none w-full font-semibold rounded-lg shadow-sm">
                            Create account
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm text-slate-500">
                    Already have an account?
                    <a href="/login{{ $selectedBook ? '?book_id=' . $selectedBook->id : '' }}"
                        class="font-semibold text-blue-600 hover:underline">
                        Sign in
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-layout.layout>