<?php

namespace App\Models;

use CodeIgniter\Model;

class Achievement_Model extends Model
{
    protected $table = "achievements";
    protected $primary_key = "id";
    protected $allowedFields = [
        'student_number',
        'title',
        'description',
        'date_awarded',
        'created_at',
        'updated_at',
    ];
}
