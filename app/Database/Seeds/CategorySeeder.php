<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        $this->db->table('categories')->insertBatch($data);
            
    }
}
