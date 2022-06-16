<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Library extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'librery';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'library_category_id',
        'link',
        'source',
        'description',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function LibraryCategory()
    {
        return $this->belongsTo(LibraryCategory::class, 'library_category_id');
    }

}