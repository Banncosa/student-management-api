<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{   
    use HasFactory;

    //allow these fields to be fillable
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'sex',
        'address',
        'year',
        'course',
        'section',
    ];

    //associates this to subject
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

}
