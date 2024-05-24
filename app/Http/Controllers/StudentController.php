<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Filtering
        if ($request->has('year')) {
            $query->where('year', $request->year);
        }
        if ($request->has('course')) {
            $query->where('course', $request->course);
        }
        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        // Sorting
        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->get('order', 'asc'));
        }

        // Pagination
        $limit = $request->get('limit', 10);
        $offset = $request->get('offset', 0);

        $students = $query->limit($limit)->offset($offset)->get();
        $count = $query->count();

        return response()->json([
            'metadata' => [
                'count' => $count,
                'search' => $request->all(),
                'limit' => $limit,
                'offset' => $offset,
                'fields' => $request->fields ?? []
            ],
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json($student);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update($request->all());
            return response()->json($student);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
