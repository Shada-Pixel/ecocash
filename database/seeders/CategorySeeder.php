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
                'name' => 'Graphic Design',
                'slug' => 'graphic_design',
                'mode'=> 1,
                'keywords' => 'photoshop, illustrator, logo, banner',
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'uiux_development',
                'mode'=> 2,
                'keywords' => 'figma, adobexd, prototype, wareframe, experience_design',
            ],
            [
                'name' => 'Web Design',
                'slug' => 'web_design',
                'mode'=> 1,
                'keywords' => 'web_template, saas_design',
            ],
            [
                'name' => 'Web Developmant',
                'slug' => 'web_development',
                'mode'=> 1,
                'keywords' => 'javascript, jquery, laravel, nodejs, django, aws',
            ],
            [
                'name' => 'Digital Marketing',
                'slug' => 'digital_marketing',
                'mode'=> 1,
                'keywords' => 'seo, smm, keyword research, compitator analysis',
            ],
            [
                'name' => 'SEO',
                'slug' => 'seo',
                'mode'=> 2,
                'keywords' => 'seo, smm, keyword research, compitator analysis',
            ],
            [
                'name' => 'Video Editing',
                'slug' => 'video_editing',
                'mode'=> 1,
                'keywords' => 'animation, youtube video, facebook video',
            ],
            [
                'name' => 'Cyber Security',
                'slug' => 'cyber_security',
                'mode'=> 1,
                'keywords' => 'panitration_testing, account_recovery',
            ]
        ];

        // Creating category
        foreach ($datas as $data) {
            $role = Category::create(['name' => $data['name'], 'slug' => $data['slug'], 'keywords' => $data['keywords'], 'mode' => $data['mode']]);
        }
    }
}
