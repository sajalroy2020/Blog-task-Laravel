<?php

namespace App\Http\Controllers;

use App\Models\Replay;
use Illuminate\Http\Request;
use App\Http\Requests\ReplayRequest;
use Illuminate\Support\Facades\Auth;

class ReplayContrroler extends Controller
{
    public function commentReplay(ReplayRequest $request){
        $replayData = $request->validated();
        $replayData['comment_id'] = $request->comment_id;
        $replayData['post_id'] = $request->post_id;
        $replayData['user_id'] = Auth::id();

        if (Replay::create($replayData)) {
            return redirect()->back()->with('SUCCESS_MESSAGE', 'Comment post successfully');
        }
        return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
    }
}
