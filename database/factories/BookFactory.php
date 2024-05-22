<?php

namespace Database\Factories;

use App\Entities\Book;
use App\Entities\Author;
use App\Entities\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->randomElement(['available', 'sold_out', 'coming_soon']),
            'author_id' => Author::factory(),
            'publisher_id' => Publisher::factory(),
        ];
    }
}
