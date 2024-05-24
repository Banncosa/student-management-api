<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $req)
    {
        $query = Student::query();
    
        // Filtering by search keyword
        if ($req->has('search')) {
            $search = $req->input('search');
            $query->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
        }
    
        // Filtering by year
        if ($req->has('year')) {
            $query->where('year', $req->input('year'));
        }
    
        // Filtering by course
        if ($req->has('course')) {
            $query->where('course', $req->input('course'));
        }
    
        // Filtering by section
        if ($req->has('section')) {
            $query->where('section', $req->input('section'));
        }
    
        // Sorting
        if ($req->has('sort')) {
            $query->orderBy($req->input('sort'), $req->input('direction', 'asc'));
        }
    
        // Pagination
        $students = $query->paginate(
            $req->input('limit', 15), 
            ['*'], 
            'page', 
            $req->input('offset', 1)
        );
    
        return response()->json([
            'metadata' => [
                'count' => $students->total(),
                'search' => $request->input('search', null),
                'limit' => $students->perPage(),
                'offset' => $students->currentPage(),
                'fields' => ['id', 'firstname', 'lastname', 'birthdate', 'sex', 'address', 'year', 'course', 'section'],
            ],
            'students' => $students->items(),
        ]);
    }    
    public function store(Request $req)
    {
        $validated = $req->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date',
            'sex' => 'required|in:MALE,FEMALE',
            'address' => 'required|string',
            'year' => 'required|integer',
            'course' => 'required|string',
            'section' => 'required|string',
        ]);

        $student = Student::create($validated);
        return response()->json($student, 201);
    }
    
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }
    
    public function update(Request $req, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $req->validate([
            'firstname' => 'sometimes|required|string',
            'lastname' => 'sometimes|required|string',
            'birthdate' => 'sometimes|required|date',
            'sex' => 'sometimes|required|in:MALE,FEMALE',
            'address' => 'sometimes|required|string',
            'year' => 'sometimes|required|integer',
            'course' => 'sometimes|required|string',
            'section' => 'sometimes|required|string',
        ]);

        $student->update($validated);
        return response()->json($student);
    }
}