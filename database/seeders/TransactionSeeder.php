<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            $user = Transaction::create([
                'particular' => $faker->word,
                'amount' => $faker->randomFloat(2, 1, 1000),
                'type' => $faker->numberBetween(1, 4),
                'category_id' => Category::inRandomOrder()->first()->id,
            ]);
        }
    }
}
