<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class AsyncChat extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'async_chat';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'counselor_category_by_user_id',
        'category_id',
        'sender_id',
        'reciver_id',
        'message',
        'status',
        'date',
        'time',
        'labels',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getCounselorByUser()
    {
        return $this->belongsTo(CounselorCategoryUser::class,'counselor_category_by_user_id','id');
    }

   
}