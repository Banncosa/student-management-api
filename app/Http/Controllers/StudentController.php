<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
    
        // Filtering by search keyword
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
        }
    
        // Filtering by year
        if ($request->has('year')) {
            $query->where('year', $request->input('year'));
        }
    
        // Filtering by course
        if ($request->has('course')) {
            $query->where('course', $request->input('course'));
        }
    
        // Filtering by section
        if ($request->has('section')) {
            $query->where('section', $request->input('section'));
        }
    
        // Sorting
        if ($request->has('sort')) {
            $query->orderBy($request->input('sort'), $request->input('direction', 'asc'));
        }
    
        // Pagination
        $students = $query->paginate(
            $request->input('limit', 15), 
            ['*'], 
            'page', 
            $request->input('offset', 1)
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
    public function store(Request $request)
{
    $validated = $request->validate([
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
public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $validated = $request->validate([
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
