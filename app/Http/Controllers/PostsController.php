<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Posts;
use DB;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('title', 'desc')->get();
        $cartItems = [];
        $posts = DB::select('SELECT * FROM posts');
        $setCart = function () {
            return '----------------------------------';
        };
//        $posts = [];

        return view('posts.index')->with('posts', $posts)->with('cartItems', $cartItems)->with('setcart', $setCart);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'body' => 'required',
            'gal_img' =>'image|nullable|max:1999'
        ]);
        //handle the fileupload
        if($request->hasFile('gal_img')) {
            //get Filenmae with extensions
            $fielNameWithExt = $request->file('gal_img')->getClientOriginalName();
            $filename = pathinfo($fielNameWithExt, PATHINFO_FILENAME);
            //get the ext
            $extension = $request->file('gal_img')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('gal_img')->storeAs('public/gal_img', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpeg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->price = $request->input('price');
        $post->user_id = auth()->user()->id;
        $post->gal_img = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page.');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'body' => 'required',
            'gal_img' =>'image|nullable|max:1999'
        ]);
        //handle the fileupload
        if($request->hasFile('gal_img')) {
            //get Filenmae with extensions
            $fielNameWithExt = $request->file('gal_img')->getClientOriginalName();
            $filename = pathinfo($fielNameWithExt, PATHINFO_FILENAME);
            //get the ext
            $extension = $request->file('gal_img')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('gal_img')->storeAs('public/gal_img', $fileNameToStore);
        }
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->price = $request->input('price');
        if ($request->hasFile('gal_img')) {
            $post->gal_img = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page.');
        }

        //if ($post->gal_img !== 'noimage.jpeg'){
          //  Storage::delete('public/gal_img/'.$post->gal_img);
        //}

        $post->delete();
        return redirect('/posts')->with('success', 'Post: ' .$post->title. ' Deleted');;
    }


}
