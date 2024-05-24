<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index(Request $request)
{
    $query = Student::query();

    if ($request->has('year')) {
        $query->where('year', $request->input('year'));
    }
    if ($request->has('course')) {
        $query->where('course', 'LIKE', '%' . $request->input('course') . '%');
    }
    if ($request->has('section')) {
        $query->where('section', 'LIKE', '%' . $request->input('section') . '%');
    }

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('firstname', 'LIKE', "%$search%")
              ->orWhere('lastname', 'LIKE', "%$search%")
              ->orWhere('course', 'LIKE', "%$search%");
        });
    }

    if ($request->has('sort')) {
        $sortFields = explode(',', $request->input('sort'));
        foreach ($sortFields as $field) {
            $direction = starts_with($field, '-') ? 'desc' : 'asc';
            $field = ltrim($field, '-');
            $query->orderBy($field, $direction);
        }
    }

    $limit = $request->input('limit', 10);
    $offset = $request->input('offset', 0);

    if ($request->has('fields')) {
        $fields = explode(',', $request->input('fields'));
        $query->select($fields);
    }

    $students = $query->offset($offset)->limit($limit)->get();
    $count = $query->count();

    return response()->json([
        'metadata' => [
            'count' => $count,
            'search' => $request->input('search'),
            'limit' => $limit,
            'offset' => $offset,
            'fields' => $request->input('fields', [])
        ],
        'students' => $students
    ]);
}


}
