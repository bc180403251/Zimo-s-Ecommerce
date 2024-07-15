<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function comment()
    {
        $comments=Comment::with('user')->get();
//        dd($comments);

        return response()->json(['comments'=> $comments]);
    }
}
