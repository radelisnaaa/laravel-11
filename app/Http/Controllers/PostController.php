<?php

namespace App\Http\Controllers;

use App\Models\Post; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\StorePostRequest;
use Illuminate\Http\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //get all posts
        $posts = Post::paginate(10);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/post', $image->hashName());

        //create post
        Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
            'reporter'  => $request->reporter,
            'source'    => $request->source,
        ]);

        //redirect to index
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id) : View
    {
        //get post by id
        $post = Post::findOrFail($id);

        //render view with post
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id) : View
    {
        $post = Post::findOrFail($id);
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id): RedirectResponse
    {
        //get post by id
        $post = Post::findOrFail($id);

        //check if image upload or not
        if ($request->hasFile('image')) {
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/post', $image->hashName());
            
            //delete old image
            Storage::delete('public/post/' . $post->image);

            //update post with new image
            $post->update([
                'image'    => $image->hashName(),
                'title'    => $request->title,
                'content'  => $request->content,
                'reporter' => $request->reporter,
                'source'   => $request->source,
            ]);
        } else {
            //update post without image
            $post->update([
                'title'    => $request->title,
                'content'  => $request->content,
                'reporter' => $request->reporter,
                'source'   => $request->source,
            ]);
        }

        //redirect to index
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        //delete image
        Storage::delete('public/post/' . $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
