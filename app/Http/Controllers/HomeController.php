<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=Post::all();
         $data=Post::orderBy('id', 'DESC')->get();
        //  $data=Post::latest()->first();
        //  dd($data);
        return  view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =Category::all();
        return view('create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $validated=$request->validated();
        Post::create($validated);
        return redirect('/posts');
  }


    public function show(Post $post)
    {
        // $post=Post::findOrFail($id);


        return view('show',compact('post'));

    }


    public function edit(Post $post)
    {

        $category=Category::all();
        return view('edit',compact('post','category'));
    }


    public function update(storePostRequest $request, Post $post)
    {

    $validated=$request->validated();
        $post->update($validated);
        return redirect('/posts');
    }


    public function destroy(Post $post)
    {
        // dd($id);
        $post->delete();
        return redirect('/posts');
    }
}
