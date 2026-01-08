<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\VideoProgress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VideoProgressController extends Controller
{
    public function get($videoId)
    {
        $progress = VideoProgress::where('user_id', Auth::id())
                    ->where('video_id', $videoId)
                    ->first();

        return response()->json(['progress' => $progress ? $progress->progress : 0]);
    }

    public function store(Request $request)
    {
        Log::info('VideoProgress store hit', $request->all());

        $request->validate([
            'video_id' => 'required|string',
            'progress' => 'required|numeric'
        ]);

        $progress = VideoProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'video_id' => $request->video_id,
            ],
            [
                'progress' => $request->progress
            ]
        );

        return response()->json(['success' => true]);
    }

    public function getAll()
    {
        $progresses = VideoProgress::where('user_id', Auth::id())->get();

        return response()->json($progresses);
    }

    public function complete(Request $request)
    {
        $request->validate([
            'video_id' => 'required|string',
        ]);

        $progress = VideoProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'video_id' => $request->video_id
            ],
            [
                'is_complete' => true
            ]
        );

        return response()->json(['message' => 'Progress updated to complete']);
    }

    public function markComplete(Request $request)
    {
        $request->validate([
            'video_id' => 'required|string',
        ]);

        $progress = VideoProgress::firstOrNew([
            'user_id' => Auth::id(),
            'video_id' => $request->video_id,
        ]);

        $progress->is_complete = true;
        $progress->save();

        return response()->json(['message' => 'Video marked as complete.']);
    }
}
