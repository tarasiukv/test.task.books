<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Entities\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::factory()->count(20)->create();
    }
}
