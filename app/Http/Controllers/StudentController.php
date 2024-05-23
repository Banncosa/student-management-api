<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::all();
    }



    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'year' => 'required|integer',
            'course' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $student = Student::create($request->all());

        return response()->json($student, 201);
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'year' => 'required|integer',
            'course' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $student->update($request->all());

        return response()->json($student);
    }
}
