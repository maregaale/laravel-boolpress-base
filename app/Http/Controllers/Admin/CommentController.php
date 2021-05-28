<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function destroy (Comment $comment)
    {
        // delete
        $comment->delete();

        return back()->with('message', 'Il commento di ' . $comment->name .  ' è stato eliminato!');
    }
}
