<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $post = Post::all();
        return response()->json($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'titulo' => 'required|max:200',
            'body'  =>  'required',
            'publicado' => 'boolean'
        ]);

        $post = new Post();
        $post->titulo = $request->titulo;
        $post->body = $request->body;
        $post->publicado = $request->publicado;

        $post->save();
        
        return response()->json([
            'message'   =>  'Post Agregado',
            'data'  =>  $post
        ], 201);
    }    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts= Post::find($id);
        if(!empty($posts))
        {
            return response()->json($posts);
        }
        else
        {
            return response()->json([
                'message' => "No encontrado",
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $post->titulo = $request->titulo;
        $post->body = $request->body;
        $post->publicado = $request->publicado;

        $post->save();

        return response()->json([
            'message'   =>  "Actualizado",
            'data'  =>  $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::destroy($request->id);
        return $post;
    }
}
