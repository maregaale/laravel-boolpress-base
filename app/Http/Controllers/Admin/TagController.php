<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;


class TagController extends Controller
{
    // validation
    protected $validation = [
        'name' => 'required|string|max:50|unique:tags', 
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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

        //validation
        $request->validate($this->validation);

        $data = $request->all();
        
        // imposto lo slug 
        $data['slug'] = Str::slug($data['name'], '-');

        // Insert
        $newTag = Tag::create($data);  
        
        // posts
        if(isset($data['posts'])) {
            $newTag->posts()->attach($data['posts']);
        }

        // return
        return redirect()->route('admin.tags.index')->with('message', 'aggiunto nuovo tag ' . "'" . $newTag->name . "'");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
       // recupero array validazione
       $validation = $this->validation;

       //validation
       $request->validate($this->validation);

       $data = $request->all();
       
       // imposto lo slug 
       $data['slug'] = Str::slug($data['name'], '-');

       // Insert
       $tag->update($data);  
       
       // posts
       if(isset($data['posts'])) {
           $tag->posts()->attach($data['posts']);
       }

       // return
       return redirect()->route('admin.tags.index')->with('message', 'modificato il tag' . $tag->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        // detach
        $tag->posts()->detach();

        //Delete
        $tag->delete();

        // return
        return redirect()->route('admin.tags.index')->with('message', "eliminato il tag " . "'" . $tag->name . "'");
    }
}
