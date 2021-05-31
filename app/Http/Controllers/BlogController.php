<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Mail\CommentNewMail;
use Illuminate\Support\Facades\Mail;


class BlogController extends Controller
{
    public function index ()
    {
        // dati
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->limit(12)->get();
        $tags = Tag::all();

        // return
        return view('guest.posts.index', compact('posts', 'tags'));
    }

    public function showPost ($slug)
    {
        // dati
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();

        // controllo 
        if ( $post == null ) {
            abort(404);
        }

        // return
        return view('guest.posts.show', compact('post', 'tags'));
    }

    public function addComment (Request $request, Post $post)
    {
        // validation
        $request->validate([
            'name' => 'nullable|string',
            'content' => 'required|string',
        ]);

        // istanzio nuovo commento
        $newComment = new Comment();
        $newComment->name = $request->name;
        $newComment->content = $request->content;
        $newComment->post_id = $post->id;
        // $newComment->created_at;
        $newComment->save();

        Mail::to('ale_marega@hotmail.it')->send(new CommentNewMail($post));

        // return
        return back();
    }

    public function filterByTag ($slug)
    {
        // dati
        $tags = Tag::all();
        $tag = Tag::where('slug', $slug)->first();

        // controllo 
        if ( $tag == null ) {
            abort(404);
        }

        $posts = $tag->posts()->where('published', 1)->get();

        // return
        return view('guest.posts.index', compact('posts', 'tags'));
    }
}
