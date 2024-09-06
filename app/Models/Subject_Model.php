<?php

namespace App\Models;

use CodeIgniter\Model;

class Subject_Model extends Model
{
    protected $table = "subjects";
    protected $primary_key = "id";
    protected $allowedFields = [
        'code',
        'title',
        'lecture_units',
        'laboratory_units',
        'hours_per_week',
        'pre_requisites',
        'created_at',
        'updated_at',
    ];
}