<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Implement search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'LIKE', "%$search%")
                  ->orWhere('lastname', 'LIKE', "%$search%");
            });
        }

        // Implement filtering by year, course, section
        if ($request->has('year')) {
            $query->where('year', $request->input('year'));
        }
        if ($request->has('course')) {
            $query->where('course', $request->input('course'));
        }
        if ($request->has('section')) {
            $query->where('section', $request->input('section'));
        }

        // Implement sorting
        if ($request->has('sort')) {
            $sortFields = explode(',', $request->input('sort'));
            foreach ($sortFields as $sortField) {
                $direction = 'asc';
                if (substr($sortField, 0, 1) === '-') {
                    $direction = 'desc';
                    $sortField = substr($sortField, 1);
                }
                $query->orderBy($sortField, $direction);
            }
        }

        // Implement pagination
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);
        $students = $query->limit($limit)->offset($offset)->get();

        return response()->json([
            'metadata' => [
                'count' => $query->count(),
                'search' => $request->input('search'),
                'limit' => $limit,
                'offset' => $offset,
                'fields' => $request->query('fields')
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
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student);
    }
}