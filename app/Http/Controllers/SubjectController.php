<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request, $student_id)
    {
        $query = Subject::where('student_id', $student_id);

        // Implement search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('subject_code', 'LIKE', "%$search%");
            });
        }

        // Implement filtering by remarks
        if ($request->has('remarks')) {
            $query->where('remarks', $request->input('remarks'));
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
        $subjects = $query->limit($limit)->offset($offset)->get();

        return response()->json([
            'metadata' => [
                'count' => $query->count(),
                'search' => $request->input('search'),
                'limit' => $limit,
                'offset' => $offset,
                'fields' => $request->query('fields')
            ],
            'subjects' => $subjects
        ]);
    }

    public function store(Request $request, $student_id)
    {
        $data = $request->all();
        $data['student_id'] = $student_id;
        $subject = Subject::create($data);
        return response()->json($subject, 201);
    }

    public function show($student_id, $id)
    {
        $subject = Subject::where('student_id', $student_id)->findOrFail($id);
        return response()->json($subject);
    }

    public function update(Request $request, $student_id, $id)
    {
        $subject = Subject::where('student_id', $student_id)->findOrFail($id);
        $subject->update($request->all());
        return response()->json($subject);
    }
}
