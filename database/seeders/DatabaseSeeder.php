<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Foydalanuvchilarni yaratish (Admin va Reader)
        User::create([
            'email' => 'admin@library.uz',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'email' => 'reader@library.uz',
            'password' => Hash::make('password'),
            'role' => 'reader',
        ]);

        // 2. Kategoriyalar
        $cat1 = Category::create(['name' => 'Dizayn va San’at']);
        $cat2 = Category::create(['name' => 'Ilmiy-ommabop']);

        // 3. Kitoblar (active_file_key uchun unikal UUID beramiz)
        Book::create([
            'category_id' => $cat1->id,
            'title' => 'Tree Atlas',
            'author' => 'J. Smith',
            'active_file_key' => (string) Str::uuid(),
            'page_count' => 240,
        ]);

        Book::create([
            'category_id' => $cat1->id,
            'title' => 'Clay Forms',
            'author' => 'A. Karimova',
            'active_file_key' => (string) Str::uuid(),
            'page_count' => 180,
        ]);

        Book::create([
            'category_id' => $cat2->id,
            'title' => 'Night Sky',
            'author' => 'M. Bek',
            'active_file_key' => (string) Str::uuid(),
            'page_count' => 310,
        ]);
    }
}