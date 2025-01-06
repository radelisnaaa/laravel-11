<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentsController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //get all students
        $students = Students::paginate(10);

        //render view with students
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentsRequest $request): RedirectResponse
    {
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/students', $image->hashName());

        //create student
        Students::create([
            'image'    => $image->hashName(),
            'name'     => $request->name,
            'age'      => $request->age,
            'address'  => $request->address,
            'phone'    => $request->phone
        ]);

        //redirect to index
        return redirect()->route('students.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : View
    {
        //get student by id
        $student = Students::findOrFail($id);

        //render view with student
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $student = Students::findOrFail($id);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentsRequest $request, string $id): RedirectResponse
    {
        //get student by id
        $student = Students::findOrFail($id);

        //check if image upload or not
        if ($request->hasFile('image')) {
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/students', $image->hashName());

            //delete old image
            Storage::delete('public/students/'.$student->image);

            //update student with new image
            $student->update([
                'image'    => $image->hashName(),
                'name'     => $request->name,
                'age'      => $request->age,
                'address'  => $request->address,
                'phone'    => $request->phone
            ]);
        } else {
            //update student without image
            $student->update([
                'name'     => $request->name,
                'age'      => $request->age,
                'address'  => $request->address,
                'phone'    => $request->phone
            ]);
        }

        //redirect to index
        return redirect()->route('students.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        $student = Students::findOrFail($id);

        //delete image
        Storage::delete('public/students/'.$student->image);

        //delete student
        $student->delete();

        //redirect to index
        return redirect()->route('students.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
