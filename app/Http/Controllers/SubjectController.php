<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(Request $request, $studentId)
    {
        $query = Subject::where('student_id', $studentId);

        // Filtering based on query parameters
        if ($request->has('sort')) {
            $query->orderBy($request->sort);
        }
        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
        }
        if ($request->has('remarks')) {
            $query->where('remarks', $request->remarks);
        }

        // Select specific fields
        $fields = $request->has('fields') ? explode(',', $request->fields) : ['*'];

        // Pagination settings
        $limit = $request->get('limit', 10);
        $offset = $request->get('offset', 0);

        // Retrieve and return the filtered records
        return $query->select($fields)->offset($offset)->limit($limit)->get();
    }

    public function add(Request $request, $studentId)
    {
        $validator = Validator::make($request->all(), [
            'subject_code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'instructor' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'grades.prelims' => 'required|numeric',
            'grades.midterms' => 'required|numeric',
            'grades.pre_finals' => 'required|numeric',
            'grades.finals' => 'required|numeric',
            'date_taken' => 'required|date',
            'student_id' => 'required|exists:students,id'
        ]);
    
        if (!$validator->fails()) {
            $validatedData = $validator->validated();
            $average_grade = array_sum($validatedData['grades']) / count($validatedData['grades']);
            $remarks = $average_grade <= 3.0 ? 'PASSED' : 'FAILED';
        
            // Create and save the new subject
            $subject = new Subject([
                'subject_code' => $validatedData['subject_code'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'instructor' => $validatedData['instructor'],
                'schedule' => $validatedData['schedule'],
                'grades' => $validatedData['grades'],
                'average_grade' => $average_grade,
                'remarks' => $remarks,
                'date_taken' => $validatedData['date_taken'],
                'student_id' => $validatedData['student_id'],
            ]);
            $subject->save();
        
            return response()->json($subject, 201);
        } else {
            return response()->json($validator->errors(), 422);
        }
    }

    public function show($studentId, $subjectId)
    {
        $subject = Subject::where('student_id', $studentId)->where('id', $subjectId)->first();
        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }
        return response()->json($subject);
    }

    public function update(Request $request, $id, $subjectId)
    {
    $subject = Subject::find($subjectId);
    if (!$subject) {
        return response()->json(['error' => 'Subject not found'], 404);
    }

    $validator = Validator::make($request->all(), [
        'subject_code' => 'string|max:255',
        'name' => 'string|max:255',
        'description' => 'string|nullable',
        'instructor' => 'string|max:255',
        'schedule' => 'string|max:255',
        'grades.prelims' => 'numeric',
        'grades.midterms' => 'numeric',
        'grades.pre_finals' => 'numeric',
        'grades.finals' => 'numeric',
        'date_taken' => 'date',
        'student_id' => 'exists:students,id'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Collect
    $validatedData = $validator->validated();

    // If grades are updated, recalculate the average grade and remarks
    if (isset($validatedData['grades'])) {
        $average_grade = array_sum($validatedData['grades']) / count($validatedData['grades']);
        $remarks = $average_grade <= 3.0 ? 'PASSED' : 'FAILED';
        $validatedData['average_grade'] = $average_grade;
        $validatedData['remarks'] = $remarks;
    }

    // Update the subject with new record
    $subject->update($validatedData);

    return response()->json($subject);
}
}
