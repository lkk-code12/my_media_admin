<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct admin trend post
    public function index()
    {
        $actionLog = ActionLog::select('action_logs.*', 'posts.*', DB::RAW('COUNT(action_logs.post_id) as post_count'))
            ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
            ->groupBy('action_logs.post_id')
            ->get();
        // dd($actionLog->toArray());
        return view('ADMIN.TREND_POST.index', compact('actionLog'));
    }

    public function details($id)
    {
        $data = Post::where('post_id',$id)->first();
        // dd($data->toArray());
        return view('ADMIN.TREND_POST.details', compact('data'));
    }
}
