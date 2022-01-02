<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
// use Illuminate\Support\Arr;
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

//         $data = [
//     'country' => 'India 🇮🇳',
//     'languages' => [
//         'Gujarati',
//         'Hindi',
//         'Sanskrit',
//         'Tamil',
//         'Urdu',
//     ],
// ];

// dd(
//    Arr::flatten($data)
// );
        // $posts=Post::all();
        // $data=[];
        // foreach($posts as $post){
        //     $data[]=$post->name;
        // }
        // dd($data);
        // dd(Post::pluck('name'));
        // $collection=[1,2,3];

        // $collection = collect([1,2,3])->map(function ($number) {
        //     return $number>2;
        // });
        // dd($collection);
        // dd(Post::all());
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
        Post::create($validated + ['user_id'=>Auth()->user()->id]);
        return redirect('/posts')->with('status', 'Post was created successfully');
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
        return redirect('/posts')->with('status', 'Post was updated successfully');
    }


    public function destroy(Post $post)
    {
        // dd($id);
        $post->delete();
        return redirect('/posts')->with('status', 'Post was deleted successfully');
    }
}
