<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Dummy posts data
        $dummyContent = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
        $data = [];
        $titles = [
            'The Future of Technology',
            '10 Tips for a Healthy Lifestyle',
            'Top Travel Destinations for 2025',
            'Delicious Recipes to Try at Home',
            'How to Stay Productive While Working from Home',
            'The Impact of Social Media on Society',
            'Exploring the Great Outdoors: Best Hiking Trails',
            'The Art of Mindfulness and Meditation',
            'Innovations in Renewable Energy',
            'A Guide to Personal Finance Management',
            'The Evolution of Artificial Intelligence',
            'Culinary Adventures: Exploring World Cuisines',
        ];

        for ($i = 0; $i < 12; $i++) {
            $title = $titles[$i];
            $slug = url_title($title, '-', true) . '-' . ($i + 1);
            
            $data[] = [
                'user_id'    => 1, // admin
                'category_id'=> ($i % 4) + 1, // Rotate through 4 categories
                'title'      => $title,
                'slug'       => $slug,
                'content'    => $dummyContent,
                'image'      => 'post' . ($i + 1) . '.jpg',
                'status'     => 'published',
                'created_at' => Time::now()->subDays(rand(0, 30)),
                'updated_at' => Time::now()->subDays(rand(0, 30)),
            ];
        }

        $this->db->table('posts')->insertBatch($data);
            
    }
}
