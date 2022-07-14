<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class LiveChat extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'live_chat';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'counselor_assignment_id',
        'sender_id',
        'reciver_id',
        'category_id',
        'message',
        'status',
        'read_status',
        'date',
        'time',
        'labels',
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
   
}