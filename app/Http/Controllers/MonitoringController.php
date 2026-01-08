<?php

namespace App\Http\Controllers;

use App\Models\VideoPart;
use Illuminate\Http\Request;
use App\Models\VideoProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function monitoring()
    {
       $progressData = DB::table('video_progress as vp')
        ->leftJoin('video_parts as vp_part', DB::raw("SUBSTRING_INDEX(vp.video_id, '/', -1)"), '=', DB::raw("SUBSTRING_INDEX(vp_part.youtube_url, '=', -1)"))
        ->leftJoin('videos as v', 'vp_part.video_id', '=', 'v.id')
        ->leftJoin('users as u', 'vp.user_id', '=', 'u.id')
        ->select(
            'vp.*',
            'u.name as user_name',
            'u.nama_pembimbing',
            'v.title as video_title',
            'vp_part.title as part_title'
        )
        ->orderBy('vp_part.id', 'asc')
        ->get();

        return view('monitoring', compact('progressData'));
    }

}
