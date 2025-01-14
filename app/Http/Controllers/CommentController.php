<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all comments
        $comments = Comment::paginate(10);
 
        //render view with comments
        return view('comments.index', compact('comments'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('comments.create');
    }
    
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    
    {
        // //upload photo
        // $photo = $request->file('photo');
        // $photo->storeAs('public/comments', $photo->hashName());

        //create comment
        Comment::create([
            'post_id'        => $request->post_id,
            'content'        => $request->content,
            'user_id'        => Auth::id(),
            // 'email'        => $request->email,
            // 'phone'        => $request->phone,
            // 'review'       => $request->review
        ]);

        //redirect to comments index
        return redirect()->route('posts.show', $request->post_id)->with(['success' => 'Data Berhasil Disimpan!']);; 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        //get comment by id
        $comment = Comment::findOrFail($id);

        //render view with comment
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View

    {
        //get comment by id
        $comment = Comment::findOrFail($id);

        //render view with comment
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id): Redirectresponse
    {
        ////get comment by id
        $comment = Comment::findOrFail($id);

    //upload photo
    if ($request->hasFile('photo')) {

        //upload new photo
        $photo = $request->file('photo');
        $photo->storeAs('public/comments', $photo->hashName());

        //delete old photo
        Storage::delete('public/comments/' . $comment->photo);

        //update comment with new photo
        // $comment->update([
        //     'photo'        => $photo->hashName(),
        //     'name'         => $request->name,
        //     'email'        => $request->email,
        //     'phone'        => $request->phone,
        //     'review'       => $request->review
    //     ]);
    // } else {
    //     //update comment without new photo
    //     $comment->update([
    //         'name'         => $request->name,
    //         'email'        => $request->email,
    //         'phone'        => $request->phone,
    //         'review'       => $request->review
    //     ]);
     }

    //redirect to comments index
    return redirect()->route('comments.index')->with(['success' => 'Comment Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        //get comment by id
        $comment = Comment::findOrFail($id);

        //delete photo
        Storage::delete('public/comments/' . $comment->photo);

        //delete comment
        $comment->delete();

        //redirect to comments index
        return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Dihapus!']);


    }
}
