<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index($student_id, Request $request)
    {
        $query = Subject::where('student_id', $student_id);

        // Filtering
        if ($request->has('remarks')) {
            $query->where('remarks', $request->remarks);
        }

        // Sorting
        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->get('order', 'asc'));
        }

        // Pagination
        $limit = $request->get('limit', 10);
        $offset = $request->get('offset', 0);

        $subjects = $query->limit($limit)->offset($offset)->get();
        $count = $query->count();

        return response()->json([
            'metadata' => [
                'count' => $count,
                'search' => $request->all(),
                'limit' => $limit,
                'offset' => $offset,
                'fields' => $request->fields ?? []
            ],
            'subjects' => $subjects
        ]);
    }

    public function store($student_id, Request $request)
    {
        $request->merge(['student_id' => $student_id]);
        $subject = Subject::create($request->all());
        return response()->json($subject, 201);
    }

    public function show($student_id, $id)
    {
        $subject = Subject::where('student_id', $student_id)->find($id);
        if ($subject) {
            return response()->json($subject);
        } else {
            return response()->json(['message' => 'Subject not found'], 404);
        }
    }

    public function update($student_id, Request $request, $id)
    {
        $subject = Subject::where('student_id', $student_id)->find($id);
        if ($subject) {
            $subject->update($request->all());
            return response()->json($subject);
        } else {
            return response()->json(['message' => 'Subject not found'], 404);
        }
    }
}
