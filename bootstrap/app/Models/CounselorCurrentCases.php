<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;


class CounselorCurrentCases extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'counselor_current_cases';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id', 
        'category_id', 
        'task_assignment_id', 
        'user_id', 
        'task_no', 
        'topic', 
        'feedback', 
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
