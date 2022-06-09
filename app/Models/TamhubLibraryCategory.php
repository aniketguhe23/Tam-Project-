<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamhubLibraryCategory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'library_category';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'library_category',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}