<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ChatHistory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'chat_history';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'counselor_past_cases_id',
        'category_id',
        'assignment_of_cc',
        'sender_id',
        'reciver_id',
        'message',
        'status',
        'date',
        'time',
        'labels',
            ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}