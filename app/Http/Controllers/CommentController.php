<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//dd($request);

        $comment = Comment::create([
            'comment' => $request->comment,            
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);

        session()->flash('success', 'Post added successfuly');
        return redirect(route('primary'));
    }
}
