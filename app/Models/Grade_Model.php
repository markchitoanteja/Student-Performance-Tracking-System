<?php

namespace App\Models;

use CodeIgniter\Model;

class Grade_Model extends Model
{
    protected $table = "grades";
    protected $primary_key = "id";
    protected $allowedFields = [
        'student_id',
        'subject_id',
        'course',
        'year',
        'semester',
        'grade',
        'created_at',
        'updated_at',
    ];
}