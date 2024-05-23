<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate->format('Y-m-d'),
            'sex' => $this->sex,
            'address' => $this->address,
            'year' => $this->year,
            'course' => $this->course,
            'section' => $this->section,
        ];
    }
}
