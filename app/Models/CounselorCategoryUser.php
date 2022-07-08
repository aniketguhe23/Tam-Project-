<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use Carbon\Carbon;


class CounselorCategoryUser extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'counselor_category_by_user';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'counselor_id',
        'user_id',
        'category_id',
        'activate_chat',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function getCounselor()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getAsync()
    {
        return $this->belongsTo(AsyncChat::class,'id','counselor_category_by_user_id');
    }


}
