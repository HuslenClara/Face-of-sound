<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);//->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            //'audiofile' => 'required|mimes:mpeg,mpga,mp3,wav|max:2048'
        ]);

        //Post::create($request->all());
        /*$user_id = auth()->user()->id;
        $user = User::find($user_id);*/
        $post = new Post;

        if ($request->hasFile('audiofile')) 
        {
            $request->file('audiofile');
            $audiofile = $request->file('audiofile');
            $new_name = rand() . '.' . $audiofile->getClientOriginalExtension();
            $audiofile->move(public_path("audioFiles"), $new_name);

            $post->audio = $new_name;
        }



        
        $post->user_id = auth()->user()->id;
        $post->body = $request->input('body');
        if(!empty($request->input('parent_post_id'))){
            $post->parent_post_id = $request->input('parent_post_id');
        }
        $post->save();

        return redirect('/home')->with('success', 'Шуугиан амжилттай нийтлэгдлээ!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required'
        ]);
        //$post->update($request->all());
        $post = Post::find($post->id);

        $post->user_id = auth()->user()->id;
        $post->body = $request->input('body');

        $post->save();
        return redirect()->route('home')
            ->with('success', 'Шуугиан амжилттай шинэчлэгдлээ!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')
            ->with('success', 'Шуугиан амжилттай устгагдлаа!');
    }
    public function collab(Post $post){
        return view('posts.collab')->with('post', $post);
    }
}
