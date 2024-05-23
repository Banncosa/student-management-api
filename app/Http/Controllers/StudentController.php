<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{   
    //getting record
    public function index(Request $request)
    {
        $query = Student::query();

        // Filtering
        if ($request->has('sort')) {
            $query->orderBy($request->sort);
        }
        if ($request->has('search')) {
            $query->where('firstname', 'like', "%{$request->search}%")
                  ->orWhere('lastname', 'like', "%{$request->search}%");
        }
        if ($request->has('year')) {
            $query->where('year', $request->year);
        }
        if ($request->has('course')) {
            $query->where('course', $request->course);
        }
        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        // Field filtering separate using comma.
        $fields = $request->has('fields') ? explode(',', $request->fields) : ['*'];

        // limiting and offset
        $limit = $request->limit ?? 10;
        $offset = $request->offset ?? 0;

        // return response ageyn
        return $query->select($fields)->offset($offset)->limit($limit)->get();
    }

    //getting specific id/single record
    public function show($id)
    { 
        $student = Student::find($id);
        return $student ? response()->json($student) : response()->json(['error' => 'Student not found'], 404);
    }

    //posting
    public function add(Request $request)
    {   
        //validation
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'sex' => 'required|in:MALE,FEMALE',
            'address' => 'required|string|max:255',
            'year' => 'required|integer|min:1',
            'course' => 'required|string|max:255',
            'section' => 'required|string|max:255'
        ]);

        //if fail return error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // otherwise return the recently added record
        $student = Student::create($validator->validated());
        return response()->json($student, 201);
    }

    //patching
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        
        //if no such student exists return error
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'string|max:255',
            'lastname' => 'string|max:255',
            'birthdate' => 'date',
            'sex' => 'in:MALE,FEMALE',
            'address' => 'string|max:255',
            'year' => 'integer|min:1',
            'course' => 'string|max:255',
            'section' => 'string|max:255'
        ]);

        //if validator is not met return the error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //return recently updated record
        $student->update($validator->validated());
        return response()->json($student);
    }

    
}

