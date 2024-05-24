<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student->subjects);
    }

    public function store(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'subject_code' => 'required|string',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'instructor' => 'required|string',
            'schedule' => 'required|string',
            'grades' => 'required|array',
            'grades.prelims' => 'nullable|numeric',
            'grades.midterms' => 'nullable|numeric',
            'grades.pre_finals' => 'nullable|numeric',
            'grades.finals' => 'nullable|numeric',
            'average_grade' => 'required|numeric',
            'remarks' => 'required|in:PASSED,FAILED',
            'date_taken' => 'required|date_format:Y-m-d'
        ]);

        $validatedData['student_id'] = $student->id;

        $subject = Subject::create($validatedData);

        return response()->json(['id' => $subject->id], 201);
    }

    public function show($id, $subject_id)
    {
        $subject = Subject::where('student_id', $id)->findOrFail($subject_id);
        return response()->json($subject);
    }

    public function update(Request $request, $id, $subject_id)
    {
        $subject = Subject::where('student_id', $id)->findOrFail($subject_id);

        $validatedData = $request->validate([
            'subject_code' => 'nullable|string',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'instructor' => 'nullable|string',
            'schedule' => 'nullable|string',
            'grades' => 'nullable|array',
            'grades.prelims' => 'nullable|numeric',
            'grades.midterms' => 'nullable|numeric',
            'grades.pre_finals' => 'nullable|numeric',
            'grades.finals' => 'nullable|numeric',
            'average_grade' => 'nullable|numeric',
            'remarks' => 'nullable|in:PASSED,FAILED',
            'date_taken' => 'nullable|date_format:Y-m-d'
        ]);

        $subject->update($validatedData);

        return response()->json($subject);
    }
}
