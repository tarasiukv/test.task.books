<?php

namespace Database\Seeders;

use App\Entities\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        Author::factory()->count(10)->create();
    }
}
