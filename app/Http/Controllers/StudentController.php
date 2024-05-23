<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::query();

        if ($request->filled('year')) {
            $students->where('year', $request->year);
        }

        if ($request->filled('course')) {
            $students->where('course', $request->course);
        }

        if ($request->filled('section')) {
            $students->where('section', $request->section);
        }

        if ($request->filled('sort')) {
            $students->orderBy($request->sort, $request->get('direction', 'asc'));
        }

        return StudentResource::collection($students->paginate($request->get('limit', 10)));
    }

    public function store(StudentRequest $request)
    {
        $student = Student::create($request->validated());
        return new StudentResource($student);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return new StudentResource($student);
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->validated());
        return new StudentResource($student);
    }
}
