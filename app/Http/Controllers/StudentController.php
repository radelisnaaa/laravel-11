<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Get all students with pagination
        $students = Student::paginate(10);

        // Render view with students
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
       
        
        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/students', $image->hashName());

        // Create student
        Student::create([
            'image'    => $image->hashName(),
            'name'     => $request->name,
            'age'      => $request->age,
            'address'  => $request->address,
            'phone'    => $request->phone,
        ]);

        // Redirect to index
        return redirect()->route('students.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // Get student by ID
        $student = Student::findOrFail($id);

        // Render view with student
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $student = Student::findOrFail($id);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $id): RedirectResponse
    {
        
        
        // Get student by ID
        $student = Student::findOrFail($id);

        // Check if image is uploaded
        if ($request->hasFile('image')) {
            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/students', $image->hashName());

            // Delete old image
            Storage::delete('public/students/' . $student->image);

            // Update student with new image
            $student->update([
                'image'    => $image->hashName(),
                'name'     => $request->name,
                'age'      => $request->age,
                'address'  => $request->address,
                'phone'    => $request->phone,
            ]);
        } else {
            // Update student without image
            $student->update([
                'name'     => $request->name,
                'age'      => $request->age,
                'address'  => $request->address,
                'phone'    => $request->phone,
            ]);
        }

        // Redirect to index
        return redirect()->route('students.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Get student by ID
        $student = Student::findOrFail($id);

        // Delete image
        Storage::delete('public/students/' . $student->image);

        // Delete student
        $student->delete();

        // Redirect to index
        return redirect()->route('students.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}