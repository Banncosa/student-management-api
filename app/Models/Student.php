<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{   
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

}
