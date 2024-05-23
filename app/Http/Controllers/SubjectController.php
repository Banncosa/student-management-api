<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index($studentId, Request $request)
    {
        $subjects = Subject::where('student_id', $studentId);

        if ($request->filled('remarks')) {
            $subjects->where('remarks', $request->remarks);
        }

        if ($request->filled('sort')) {
            $subjects->orderBy($request->sort, $request->get('direction', 'asc'));
        }

        return SubjectResource::collection($subjects->paginate($request->get('limit', 10)));
    }

    public function store($studentId, SubjectRequest $request)
    {
        $subject = new Subject($request->validated());
        $subject->student_id = $studentId;
        $subject->average_grade = array_sum($subject->grades) / count($subject->grades);
        $subject->remarks = $subject->average_grade >= 3.0 ? 'PASSED' : 'FAILED';
        $subject->save();
        return new SubjectResource($subject);
    }

    public function show($studentId, $subjectId)
    {
        $subject = Subject::where('student_id', $studentId)->findOrFail($subjectId);
        return new SubjectResource($subject);
    }

    public function update(SubjectRequest $request, $studentId, $subjectId)
    {
        $subject = Subject::where('student_id', $studentId)->findOrFail($subjectId);
        $subject->update($request->validated());
        $subject->average_grade = array_sum($subject->grades) / count($subject->grades);
        $subject->remarks = $subject->average_grade >= 3.0 ? 'PASSED' : 'FAILED';
        $subject->save();
        return new SubjectResource($subject);
    }
}
