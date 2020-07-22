<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\Reply;
use Redirect;

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

    /**
     * Store a reply created against a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savereplytocomment(Request $request)
    {
        //dd($request);
        $reply = Reply::create([
            'reply'      => $request->reply_to_comment,            
            'comment_id' => $request->comment_id,
            'user_id'    => Auth::id()
        ]);
        session()->flash('success', 'Post added successfuly');
        return Redirect::back();

        
    }
}
