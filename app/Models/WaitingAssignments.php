<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Models\User;
use App\Models\Category;

class WaitingAssignments extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'watting_assignments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'waiting_status',
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
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCounselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

}
