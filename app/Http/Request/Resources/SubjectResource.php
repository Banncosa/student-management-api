<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject_code' => $this->subject_code,
            'name' => $this->name,
            'description' => $this->description,
            'instructor' => $this->instructor,
            'schedule' => $this->schedule,
            'grades' => $this->grades,
            'average_grade' => $this->average_grade,
            'remarks' => $this->remarks,
            'date_taken' => $this->date_taken->format('Y-m-d'),
        ];
    }
}
