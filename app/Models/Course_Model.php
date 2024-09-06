<?php

namespace App\Models;

use CodeIgniter\Model;

class Course_Model extends Model
{
    protected $table = "courses";
    protected $primary_key = "id";
    protected $allowedFields = [
        'code',
        'title',
        'years',
        'created_at',
        'updated_at',
    ];
}