<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@bukukita.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Sample Users
        User::create([
            'nama' => 'John Doe',
            'email' => 'user@bukukita.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        User::create([
            'nama' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Categories
        $kategoris = [
            'Fiksi',
            'Non-Fiksi',
            'Teknologi',
            'Bisnis',
            'Sains',
            'Sejarah',
            'Agama',
            'Komik',
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create(['nama' => $kategori]);
        }

        // Create Sample Books
        $bukus = [
            [
                'kategori_id' => 1,
                'isbn' => '978-1234567890',
                'judul' => 'Harry Potter dan Batu Bertuah',
                'penulis' => 'J.K. Rowling',
                'penerbit' => 'Gramedia',
                'tahun' => 1997,
                'harga' => 95000,
                'stok' => 50,
                'deskripsi' => 'Buku pertama dari seri Harry Potter yang mengisahkan petualangan seorang anak penyihir.',
                'gambar' => 'default.jpg',
            ],
            [
                'kategori_id' => 3,
                'isbn' => '978-0987654321',
                'judul' => 'Belajar Laravel untuk Pemula',
                'penulis' => 'Budi Santoso',
                'penerbit' => 'Elex Media',
                'tahun' => 2023,
                'harga' => 120000,
                'stok' => 30,
                'deskripsi' => 'Panduan lengkap belajar Laravel dari dasar hingga mahir.',
                'gambar' => 'default.jpg',
            ],
            [
                'kategori_id' => 4,
                'isbn' => '978-1122334455',
                'judul' => 'Rich Dad Poor Dad',
                'penulis' => 'Robert Kiyosaki',
                'penerbit' => 'Gramedia',
                'tahun' => 1997,
                'harga' => 85000,
                'stok' => 100,
                'deskripsi' => 'Buku tentang kecerdasan finansial dan cara mengatur keuangan.',
                'gambar' => 'default.jpg',
            ],
            [
                'kategori_id' => 2,
                'isbn' => '978-5566778899',
                'judul' => 'Sapiens: A Brief History of Humankind',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Pustaka Jaya',
                'tahun' => 2011,
                'harga' => 150000,
                'stok' => 25,
                'deskripsi' => 'Sejarah singkat umat manusia dari masa prasejarah hingga modern.',
                'gambar' => 'default.jpg',
            ],
            [
                'kategori_id' => 1,
                'isbn' => '978-6677889900',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun' => 2005,
                'harga' => 75000,
                'stok' => 60,
                'deskripsi' => 'Kisah inspiratif tentang perjuangan anak-anak dari keluarga miskin untuk menuntut ilmu.',
                'gambar' => 'default.jpg',
            ],
        ];

        foreach ($bukus as $buku) {
            Buku::create($buku);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin: admin@bukukita.com / admin123');
        $this->command->info('User: user@bukukita.com / user123');
    }
}
