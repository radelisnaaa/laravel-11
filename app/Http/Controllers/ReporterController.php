<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use App\Http\Requests\StoreReporterRequest;
use App\Http\Requests\UpdateReporterRequest;

class ReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all posts
        $reporters = Reporter::paginate(10);

        //render view with posts
        return view('reporters.index', compact('reporters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('reporters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReporterRequest $request)
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'          => 'required|min:5',
            'email'         => 'required|min:10',
            'phone'         => 'required|numeric',
            'address'       => 'required|min:5'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //create reporter
        Reporter::create([
            'image'   => $image->hashName(),
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->route('reporters.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporter $reporter)
    {
        //get reporter by ID
        $reporter = Reporter::findOrFail($reporter->id);

        //render view with reporter
        return view('reporters.show', compact('reporter'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporter $reporter)
    {
        //get reporter by ID
        $reporter = Reporter::findOrFail($reporter->id);

        //render view with reporter
        return view('reporters.show', compact('reporter'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReporterRequest $request, Reporter $reporter)
    {
        //validate form
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'name'          => 'required|min:5',
            'email'         => 'required|min:10',
            'phone'         => 'required|numeric',
            'address'       => 'required|min:5'
        ]);

        //get reporter by ID
        $reporter = Reporter::findOrFail($reporter->id);

        //check if image upload or not
        if ($request->hasFile('image')) {
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/reporters', $image->hashName());

            //delete old image
            Storage::delete('public/reporters/' . $reporter->image);

            //update reporter with new image
            $reporter->update([
                'image'   => $image->hashName(),
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'address' => $request->address
            ]);
        } else {
            //update reporter without image
            $reporter->update([
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'address' => $request->address
            ]);
            //redirect to index
            return redirect()->route('reporters.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporter $reporter)
    {
        //get reporter by ID
        $reporter = Reporter::findOrFail($reporter->id);

        //delete  image
        Storage::delete('public/reporters/' . $reporter->image);

        //delete reporter
        $reporter->delete();

        //redirect to index
        return redirect()->route('reporters.index')->with(['success' => 'Data Berhasil Dihapus!']);

        

    }
}
