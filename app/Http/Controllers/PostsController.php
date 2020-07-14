<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' =>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')-> with('post', $post); //Display the Activities
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
        $this->validate($request,[
            'title'=> 'required',
            'body' => 'required',
            // 'cover_img'=>'image|nullable|max:1999'
        ]);

        // // Handle File Upload
        // if($request->hasFile('cover_img')){
        //     // Get File name with Extension
        //     $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
        //     // Get Just File name
        //     $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //     // Get Just File Extension
        //     $extension = $request->file('cover_img')->getClientOriginalExtension();
        //     // Store File name
        //     $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path=$request->file('cover_img')->storeAs('public/cover_images', $fileNameToStore);
        // } else{
        //     $fileNameToStore='noimage.jpg';
        // }

        // Create Post
        $post = new Post;
        $post-> title = $request->input('title'); //Gets Title Submitted into the form
        $post-> body = $request->input('body'); // Gets Message Submitted
        $post-> user_id= auth()->user()->id;
        // $post-> cover_img = $fileNameToStore;
        $post-> save();

        return redirect('/post')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts= Post::find($id);
        return view('posts.show')->with('posts',$posts); //Show All Post Created 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts= Post::find($id);
        // Check for correct user
        if(auth()->user()->id != $posts->user_id){
            return redirect('/post')->with('error','Unauthorized Page');
        }
        return view('posts.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body' => 'required',
        ]);

        // Handle File Upload
        // if($request->hasFile('cover_img')){
        //     // Get File name with Extension
        //     $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
        //     // Get Just File name
        //     $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //     // Get Just File Extension
        //     $extension = $request->file('cover_img')->getClientOriginalExtension();
        //     // Store File name
        //     $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path=$request->file('cover_img')->storeAs('public/cover_images', $fileNameToStore);
        // }
        // Update Post
        $post=Post::find($id);
        $post-> title = $request->input('title'); //Gets Title Submitted into the form
        $post-> body = $request->input('body'); // Gets Message Submitted
        // if($request->hasFile('cover_img')){
        //     $post-> cover_img = $fileNameToStore;
        // }
        $post-> save();

        return redirect('/post')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts= Post::find($id);
                // Check for correct user
        if(auth()->user()->id != $posts->user_id){
            return redirect('/post')->with('error','Unauthorized Page');
        }

        // if($posts->cover_img != 'noimage.jpg'){
        //     // Delete Image too
        //     Storage::delete('public/cover_images/'.$posts->cover_img);
        // }
        $posts->delete();
        return redirect('/post')->with('success','Post Deleted');
    }
}
 