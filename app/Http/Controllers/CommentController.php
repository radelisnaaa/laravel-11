<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

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
    public function store(StoreCommentRequest $request) 
    {
        //upload photo
        $photo = $request->file('photo');
        $photo->storeAs('public/comments', $photo->hashName());

        //create comment
        Comment::create([
            'photo'        => $photo->hashName(),
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'review'       => $request->review
        ]);

        //redirect to comments index
        return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Disimpan!']);; 

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //get comment by id
        $comment = Comment::findOrFail($comment->id);

        //render view with comment
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //get comment by id
        $comment = Comment::findOrFail($comment->id);

        //render view with comment
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        ////get comment by id
        $comment = Comment::findOrFail($comment->id);

    //upload photo
    if ($request->hasFile('photo')) {
        //upload new photo
        $photo = $request->file('photo');
        $photo->storeAs('public/comments', $photo->hashName());

        //delete old photo
        Storage::delete('public/comments/' . $comment->photo);

        //update comment with new photo
        $comment->update([
            'photo'        => $photo->hashName(),
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'review'       => $request->review
        ]);
    } else {
        //update comment without new photo
        $comment->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'review'       => $request->review
        ]);
    }

    //redirect to comments index
    return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        //get comment by id
        $comment = Comment::findOrFail($comment->id);

        //delete photo
        Storage::delete('public/comments/' . $comment->photo);

        //delete comment
        $comment->delete();

        //redirect to comments index
        return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Dihapus!']);


    }
}
