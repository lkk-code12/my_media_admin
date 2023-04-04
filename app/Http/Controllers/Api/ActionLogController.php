<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //action log post
    public function actionLogPost(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];

        ActionLog::create($data);
        $data = ActionLog::where('post_id',$request->post_id)->get();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }
}
