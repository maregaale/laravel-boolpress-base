<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $validation = [
        'date' => 'required|date',
        'content' => 'required|string',
        'image' => 'nullable|url'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // recupero i tag
        $tags = Tag::all();

        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // recupero array validazione
        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts';

        //validation
        $request->validate($this->validation);

        $data = $request->all();
        
        // controllo checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;

        // imposto lo slug 
        $data['slug'] = Str::slug($data['title'], '-');

        // Insert
        $newPost = Post::create($data);    

        // tags
        $newPost->tags()->attach($data['tags']);

        // return
        return redirect()->route('admin.posts.index')->with('message', 'aggiunto nuovo post');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // recupero i tag
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // recupero array validazione
        $validation = $this->validation;
        // eccezione
        $validation['title'] = 'required|string|max:255|unique:posts,title,' . $post->id;

        //validation
        $request->validate($this->validation);

        $data = $request->all();
        
        // controllo checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;

        // imposto lo slug 
        $data['slug'] = Str::slug($data['title'], '-');

        // Insert
        $post->update($data);    

        // sync
        $post->tags()->sync($data['tags']);

        // return
        return redirect()->route('admin.posts.index', $post)->with('message', "modificato il post " . "'" . $post->title . "'");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // detach
        $post->tags()->detach();

        // delete
        $post->delete();

        // return
        return redirect()->route('admin.posts.index')->with('message', 'eliminato post');
    }
}
