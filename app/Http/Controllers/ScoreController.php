<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //get all scores
        $scores = Score::paginate(10);

        //render view with scores
        return view('scores.index', compact('scores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('scores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScoreRequest $request): RedirectResponse
    {
        
        //create score
        Score::create([
            'ipa' => $request->ipa,
            'ips' => $request->ips,
            'mtk' => $request->mtk,
            'bindo'=> $request->bindo,
            'bing' => $request->bing
        ]);

        //redirect to index
        return redirect()->route('scores.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : View
    {
        //get score by id
        $score = Score::findOrFail($id);

        

        //render view with score
        return view('scores.show', compact('score'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $score = Score::findOrFail($id);

        return view('scores.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScoreRequest $request, string $id): RedirectResponse
    {
        
        //get score by id
        $score = Score::findOrFail($id);
        
        
        //update score
        $score->update([
            'ipa' => $request->ipa,
            'ips' => $request->ips,
            'mtk' => $request->mtk,
            'bindo' => $request->bindo,
            'bing' => $request->bing
        ]);
        //redirect to index
        return redirect()->route('scores.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        $score = Score::findOrFail($id);

        //delete score
        $score->delete();

        //redirect to index
        return redirect()->route('scores.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
