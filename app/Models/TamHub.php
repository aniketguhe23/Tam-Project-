<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class TamHub extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tamhub';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'organisation_name',
        'city',
        'areas',
        'services',
        'special_note',
        'contact_no',
        'email_id',
        'website_link',
        'address',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

   
}
