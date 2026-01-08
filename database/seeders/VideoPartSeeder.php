<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\VideoPart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoPartSeeder extends Seeder
{
    public function run(): void
    {
       $videoPhp = Video::where('title', 'Pengenalan PHP')->first();

        if ($videoPhp) {
            VideoPart::create([
                'video_id' => $videoPhp->id,
                'title' => 'Part 1: Apa itu PHP?',
                'youtube_url' => 'https://www.youtube.com/watch?v=vRkIuENriKc'
            ]);

            VideoPart::create([
                'video_id' => $videoPhp->id,
                'title' => 'Part 2: Sintaks Dasar PHP',
                'youtube_url' => 'https://www.youtube.com/watch?v=Nq5rzeJ5Ab4'
            ]);

            VideoPart::create([
                'video_id' => $videoPhp->id,
                'title' => 'Part 3: Variabel dan Tipe Data',
                'youtube_url' => 'https://www.youtube.com/watch?v=jf9lHidkh2g'
            ]);
        }

        $videoLaravel = Video::where('title', 'Menggunakan Framework Laravel')->first();

        if ($videoLaravel) {
            VideoPart::create([
                'video_id' => $videoLaravel->id,
                'title' => 'Part 1: Apa itu Laravel?',
                'youtube_url' => 'https://www.youtube.com/watch?v=vRkIuENriKc'
            ]);

            VideoPart::create([
                'video_id' => $videoLaravel->id,
                'title' => 'Part 2: Sintaks Dasar Laravel',
                'youtube_url' => 'https://www.youtube.com/watch?v=vRkIuENriKc'
            ]);

            VideoPart::create([
                'video_id' => $videoLaravel->id,
                'title' => 'Part 3: Fitur Utama Laravel',
                'youtube_url' => 'https://www.youtube.com/watch?v=vRkIuENriKc'
            ]);
        }

        $videoJs = Video::where('title', 'Belajar Dasar-Dasar JS')->first();
        
        if ($videoJs){
            VideoPart::create([
                'video_id' => $videoJs->id,
                'title' => 'Part 1: Framwork JS',
                'youtube_url' => 'https://www.youtube.com/watch?v=HInw_hiVtQE',
            ]);

            VideoPart::create([
                'video_id' => $videoJs->id,
                'title' => 'Part 2: Perintah Dasar JS',
                'youtube_url' => 'https://www.youtube.com/watch?v=5o4zah19w1M',
            ]);

            VideoPart::create([
                'video_id' => $videoJs->id,
                'title' => 'Part 3: Negara Yang Menggunakan JS',
                'youtube_url' => 'https://www.youtube.com/watch?v=pD4QKe7NzL0',
            ]);
        }
    }
}
