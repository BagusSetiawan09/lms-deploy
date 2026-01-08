<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoPart;
use App\Models\VideoProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MateriController extends Controller
{
    private $apiKey = 'AIzaSyCAKrUZwJ4bk0RN4LjZi6hylc3lwJXA1Jk';

    public function index()
    {
        $videos = Video::with('parts')->get();
        return view('materi', compact('videos'));
    }

    public function show($slug)
    {
        $materi = Video::where('slug', $slug)->firstOrFail();
        $parts = VideoPart::where('video_id', $materi->id)->get();

        // Validasi video menggunakan YouTube API
        $validParts = [];
        foreach ($parts as $part) {
            $videoId = $this->getValidVideoId($part->youtube_url);
            if ($videoId) {
                $part->video_id = $videoId; // ditambahkan agar bisa digunakan di view
                $validParts[] = $part;
            }
        }

        // Ambil progress video berdasarkan user yang login
        $progresses = VideoProgress::whereIn('video_id', collect($validParts)->pluck('video_id'))
            ->where('user_id', Auth::id())
            ->get()
            ->keyBy('video_id');

        // Tandai part mana yang sudah complete
        foreach ($validParts as $part) {
            $part->is_complete = $progresses[$part->video_id]->is_complete ?? false;
        }

        // Juga kirimkan daftar progress ke view untuk logika pembukaan part
        $videoProgress = VideoProgress::where('user_id', Auth::id())
            ->pluck('is_complete', 'video_id');

        return view('materi.show', [
            'materi' => $materi,
            'parts' => $validParts,
            'videoProgress' => $videoProgress,
        ]);
    }

    private function getValidVideoId($youtubeUrl)
    {
        preg_match('/(?:youtu\.be\/|v=)([^\&\?\/]+)/', $youtubeUrl, $matches);
        $videoId = $matches[1] ?? null;

        if (!$videoId) return null;

        $apiUrl = "https://www.googleapis.com/youtube/v3/videos?part=status&id=$videoId&key=" . $this->apiKey;
        $response = Http::get($apiUrl);

        if ($response->successful() && !empty($response['items'])) {
            $status = $response['items'][0]['status'];
            if ($status['privacyStatus'] === 'public') {
                return $videoId;
            }
        }

        return null;
    }
}
