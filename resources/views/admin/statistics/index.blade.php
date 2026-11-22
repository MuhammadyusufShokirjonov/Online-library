<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics — Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900 min-h-screen antialiased">
    
    <x-layout.admin-nav />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
        
        <!-- Sarlavha (Mockup A01/A02) -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Statistics</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Current catalog · All time</p>
        </div>

        <!-- 1-QISIM: 3 ta kartochka (Mobilda 3 ustun yonma-yon, Desktopda ikonkalar bilan) -->
        <div class="grid grid-cols-3 gap-2 sm:gap-6 mb-8 sm:mb-10">
            
            <!-- 1. Books (Och ko'k fonli) -->
            <div class="bg-sky-50/70 border border-sky-100 rounded-xl p-3 sm:p-6 flex items-center justify-between">
                <div>
                    <span class="block text-[11px] sm:text-sm font-semibold text-slate-700 mb-0.5 sm:mb-1.5">Books</span>
                    <span class="text-xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $totalBooks }}</span>
                </div>
                <!-- Ikonka: Faqat desktopda ko'rinadi (sm:flex), mobilda yashirinadi -->
                <div class="hidden sm:flex w-9 h-9 rounded-lg bg-sky-100 text-sky-600 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>

            <!-- 2. Online reads -->
            <div class="bg-white border border-slate-200 rounded-xl p-3 sm:p-6 flex items-center justify-between shadow-sm">
                <div>
                    <span class="block text-[11px] sm:text-sm font-semibold text-slate-700 mb-0.5 sm:mb-1.5 leading-tight">Online reads</span>
                    <span class="text-xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $totalReads }}</span>
                </div>
                <!-- Ikonka: Faqat desktopda ko'rinadi -->
                <div class="hidden sm:flex w-9 h-9 rounded-lg bg-slate-100 text-slate-600 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>

            <!-- 3. PDF downloads -->
            <div class="bg-white border border-slate-200 rounded-xl p-3 sm:p-6 flex items-center justify-between shadow-sm">
                <div>
                    <span class="block text-[11px] sm:text-sm font-semibold text-slate-700 mb-0.5 sm:mb-1.5 leading-tight">PDF downloads</span>
                    <span class="text-xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $totalDownloads }}</span>
                </div>
                <!-- Ikonka: Faqat desktopda ko'rinadi -->
                <div class="hidden sm:flex w-9 h-9 rounded-lg bg-slate-100 text-slate-600 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
            </div>

        </div>

        <!-- 2-QISIM: 2 ta reyting jadvali (Desktopda 2 ustun, mobilda ustma-ust) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            
            <!-- 1. Most read online -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
                <div class="p-5 sm:p-6 pb-3 sm:pb-4">
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900">Most read online</h2>
                </div>

                <div class="w-full">
                    <table class="table w-full">
                        <thead class="bg-slate-50 border-t border-b border-slate-100 text-slate-600 text-xs font-semibold">
                            <tr>
                                <th class="py-2.5 px-4 sm:px-6 text-left font-semibold">Book</th>
                                <th class="py-2.5 px-4 sm:px-6 text-right font-semibold">Reads</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse ($mostReadBooks as $book)
                                <tr>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-900">{{ $book->title }}</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-right font-semibold text-slate-700">{{ $book->reads_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-8 px-6 text-center text-slate-400 text-sm">
                                        No activity yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. Most downloaded -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
                <div class="p-5 sm:p-6 pb-3 sm:pb-4">
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900">Most downloaded</h2>
                </div>

                <div class="w-full">
                    <table class="table w-full">
                        <thead class="bg-slate-50 border-t border-b border-slate-100 text-slate-600 text-xs font-semibold">
                            <tr>
                                <th class="py-2.5 px-4 sm:px-6 text-left font-semibold">Book</th>
                                <th class="py-2.5 px-4 sm:px-6 text-right font-semibold">Downloads</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse ($mostDownloadedBooks as $book)
                                <tr>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-900">{{ $book->title }}</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-right font-semibold text-slate-700">{{ $book->downloads_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-8 px-6 text-center text-slate-400 text-sm">
                                        No activity yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>
</body>
</html>