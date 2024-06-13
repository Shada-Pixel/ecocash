<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data list
        $datas = [
            [
                'name' => 'Hand Cash',
                'folio' => null,
                'mode'=> 1,
            ],
            [
                'name' => 'Towhid Shordar',
                'folio' => 12,
                'mode'=> 1,
            ],
            [
                'name' => 'Office expense',
                'folio' => 13,
                'mode'=> 2,
            ],
            [
                'name' => 'Rejaul shordar',
                'folio' => 50,
                'mode'=> 1,
            ],
            [
                'name' => 'Yunus Hujur',
                'folio' => 52,
                'mode'=> 1,
            ],
            [
                'name' => 'Aktarul Botiaghata',
                'folio' => 54,
                'mode'=> 1,
            ],
            [
                'name' => 'Ismail Pailing',
                'folio' => 55,
                'mode'=> 2,
            ],
            [
                'name' => 'Durlob shordar',
                'folio' => 56,
                'mode'=> 1,
            ],
            [
                'name' => 'Shorear cearing',
                'folio' => 99,
                'mode'=> 1,
            ]
        ];

        // Creating category
        foreach ($datas as $data) {
            $role = Category::create(['name' => $data['name'], 'folio' => $data['folio'], 'mode' => $data['mode']]);
        }
    }
}
