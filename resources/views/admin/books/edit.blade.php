<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $book->title }} — Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900 min-h-screen antialiased">
    
    <x-layout.admin-nav />

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        
        <div class="mb-4">
            <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to books</span>
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Edit book</h1>
        </div>

        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-14 items-start">
                
                <!-- Book information -->
                <div>
                    <h2 class="text-lg font-bold text-slate-900 mb-4">Book information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required 
                                class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg text-sm">
                            @error('title') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="author" class="block text-sm font-semibold text-slate-700 mb-1">Author</label>
                            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required 
                                class="input input-bordered w-full bg-white border-slate-300 text-slate-900 focus:border-blue-600 focus:outline-none rounded-lg text-sm">
                            @error('author') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1">Category</label>
                            <select name="category_id" id="category_id" required 
                                class="select select-bordered w-full bg-white border-slate-300 text-slate-700 focus:border-blue-600 focus:outline-none rounded-lg text-sm font-normal">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Files -->
                <div>
                    <h2 class="text-lg font-bold text-slate-900 mb-4">Files</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="pdf" class="block text-sm font-semibold text-slate-700 mb-1">PDF file (Replace)</label>
                            <input type="file" name="pdf" id="pdf" accept="application/pdf" 
                                class="file-input file-input-bordered w-full bg-white border-slate-300 text-slate-700 rounded-lg text-sm">
                            <span class="text-xs text-slate-400 mt-1.5 block">The current PDF stays available until its replacement is ready.</span>
                            @error('pdf') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="cover" class="block text-sm font-semibold text-slate-700 mb-1">Cover image (Replace)</label>
                            <input type="file" name="cover" id="cover" accept="image/png,image/jpeg" 
                                class="file-input file-input-bordered w-full bg-white border-slate-300 text-slate-700 rounded-lg text-sm">
                            <span class="text-xs text-slate-400 mt-1.5 block">JPG or PNG. Books without an image use a default cover.</span>
                            @error('cover') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="border-t border-slate-200 mt-8 pt-6 flex items-center gap-3">
                <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white border-none font-semibold px-6 rounded-lg shadow-sm">
                    Save changes
                </button>
                <a href="{{ route('admin.books.index') }}" class="btn bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-semibold px-6 rounded-lg">
                    Cancel
                </a>
            </div>
        </form>

    </main>
</body>
</html>