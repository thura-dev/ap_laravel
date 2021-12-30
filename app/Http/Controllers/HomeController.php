<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->only('index','create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=Post::all();
         $data=Post::where('user_id',auth()->id())->orderBy('id', 'DESC')->get();
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

        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }
        $this->authorize('view', $post);
        return view('show',compact('post'));

    }


    public function edit(Post $post)
    {
                // if($post->user_id != auth()->id()){
                //     abort(403);
                // }
        $this->authorize('view', $post);
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