<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Models\User;
use App\Models\Category;

class CounselorAssignment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'counselor_assignment';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'counselor_id',
        'category_id',
        'user_id',
        'chat_type', 
        'availability'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'user_id');
    }

    public function getCounselor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
