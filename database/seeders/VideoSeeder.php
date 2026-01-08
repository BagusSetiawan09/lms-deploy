<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    public function run(): void
    {

        Video::create([
            'title' => 'Pengenalan PHP',
            'slug' => Str::slug('Pengenalan PHP') . '-' . uniqid(),
            'description' => 'Video pengenalan dasar-dasar PHP.',
            'youtube_url' => 'https://www.youtube.com/watch?v=l1W2OwV5rgY',
        ]);

        Video::create([
            'title' => 'Menggunakan Framework Laravel',
            'slug' => Str::slug('Menggunakan Framework Laravel') . '-' . uniqid(),
            'description' => 'Video pengenalan dan penggunaan dasar framework Laravel.',
            'youtube_url' => 'https://www.youtube.com/watch?v=dstuitW8PWM&list=RDXFkzRNyygfk&index=11',
        ]);

        Video::create([
            'title' => 'Belajar Dasar-Dasar JS',
            'slug'=> Str::slug('Belajar Dasar-Dasar JS') . '-' . uniqid(),
            'description' => 'Belajar Cara Menggunakan JS.',
            'youtube_url' => 'https://www.youtube.com/watch?v=Pi9J4epTWGM&list=RDXFkzRNyygfk&index=9',
        ]);

        Video::create([
            'title' => 'Belajar Dasar-Dasar Python',
            'slug'=> Str::slug('Belajar Dasar-Dasar Python') . '-' . uniqid(),
            'description' => 'Belajar Cara Menggunakan Python.',
            'youtube_url' => 'https://www.youtube.com/watch?v=DPn1jwz3Wqk&list=RDXFkzRNyygfk&index=12',
        ]);

         Video::create([
            'title' => 'Belajar Dasar-Dasar C++',
            'slug'=> Str::slug('Belajar Dasar-Dasar C++') . '-' . uniqid(),
            'description' => 'Belajar Cara Menggunakan C++.',
            'youtube_url' => 'https://www.youtube.com/watch?v=l1W2OwV5rgY',
        ]);
        
    }
}
