<?php

namespace App\Http\Controllers;

//import model post
use App\Models\Post; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all posts
        $posts = Post::latest()->paginate(10);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'content'       => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        Post::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'content'       => $request->content
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $post = Post::findOrFail($id);

        //render view with post
        return view('posts.show', compact('post'));
    }
}
