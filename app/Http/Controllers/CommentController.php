<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{


    public function commentPost(CommentRequest $request, $id)
    {
        $commentData = $request->validated();
        $commentData['category_id'] = $id;
        $commentData['post_id'] = $request->post_id;
        $commentData['user_id'] = Auth::id();

        if (Comment::create($commentData)) {
            return redirect()->back()->with('SUCCESS_MESSAGE', 'Comment post successfully');
        }
        return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
    }


}
