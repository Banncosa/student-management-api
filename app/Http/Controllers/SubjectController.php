<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::query();
        $search = $request->input('search');
        $sort = $request->input('sort');
        $direction = $request->input('direction', 'asc');
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $fields = $request->input('fields');

        // Apply Sorting
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        // Apply Searching
        if ($search) {
            $query->where('subject_code', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
        }

        // Apply Limit and Offset
        $subjects = $query->skip($offset)->take($limit)->get();

        // Apply Selecting Fields
        if ($fields) {
            $fieldsArray = explode(',', $fields);
            $query->select($fieldsArray);
        }

        // Format subjects
        $formattedSubjects = [];
        foreach ($subjects as $subject) {
            $formattedSubjects[] = $this->formatSubject($subject);
        }

        // Prepare metadata
        $metadata = [
            'count' => count($formattedSubjects),
            'limit' => $limit,
            'offset' => $offset,
            'search' => $search,
            'fields' => $fields
        ];

        return response()->json([
            'metadata' => $metadata,
            'subjects' => $formattedSubjects
        ]);
    }

    public function store(Request $request, $studentId)
    {
        // Validate request data
        $validatedData = $request->validate([
            'subject_code' => 'required|string',
            'name' => 'required|string',
            // Add validation rules for other attributes
        ]);

        // Create the subject for the student
        $subject = new Subject();
        $subject->student_id = $studentId;
        $subject->fill($validatedData);
        $subject->save();

        return response()->json($subject, 201);
    }

    public function show($studentId, $subjectId)
    {
        $subject = Subject::where('student_id', $studentId)
                          ->findOrFail($subjectId);

        // Format the subject
        $formattedSubject = $this->formatSubject($subject);

        return response()->json($formattedSubject);
    }

    public function update(Request $request, $studentId, $subjectId)
    {
        // Validate request data
        $validatedData = $request->validate([
            'subject_code' => 'string',
            'name' => 'string',
            // Add validation rules for other attributes
        ]);

        // Find the subject
        $subject = Subject::where('student_id', $studentId)
                          ->findOrFail($subjectId);

        // Update subject attributes
        $subject->fill($validatedData);
        $subject->save();

        return response()->json($subject);
    }

    // Helper method to format subject response
    private function formatSubject($subject)
    {
        return [
            'id' => $subject->id,
            'subject_code' => $subject->subject_code,
            'name' => $subject->name,
            'description' => $subject->description,
            'instructor' => $subject->instructor,
            'schedule' => $subject->schedule,
            'grades' => [
                'prelims' => $subject->prelims,
                'midterms' => $subject->midterms,
                'pre_finals' => $subject->pre_finals,
                'finals' => $subject->finals,
            ],
            'average_grade' => $subject->average_grade,
            'remarks' => $subject->remarks,
            'date_taken' => $subject->date_taken,
        ];
    }
}