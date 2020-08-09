<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index( $course_id )
    {
        $comments = Comment::where('course_id', $course_id)->get();
        return $comments;
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->message = $request->get('message');
        $comment->course_id = $request->get('course_id');
        $comment->user_id = Auth::user()->id;
        $comment->user = Auth::user()->name;
        $comment->photo = $request->get('photo');
        $comment->save();
        return $comment;
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->message = $request->get('message');
        $comment->save();

        return $comment;
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }
}
