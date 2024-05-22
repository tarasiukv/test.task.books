<?php

namespace Database\Seeders;

use App\Entities\Publisher;
use Illuminate\Database\Seeder;

class PublishersTableSeeder extends Seeder
{
    public function run()
    {
        Publisher::factory()->count(5)->create();
    }
}
