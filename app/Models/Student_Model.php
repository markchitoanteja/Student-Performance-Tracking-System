<?php

namespace App\Models;

use CodeIgniter\Model;

class Student_Model extends Model
{
    protected $table = "students";
    protected $primary_key = "id";
    protected $allowedFields = [
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'mobile_number',
        'email',
        'address',
        'image',
        'student_number',
        'course',
        'year',
        'section',
        'created_at',
        'updated_at',
    ];
}