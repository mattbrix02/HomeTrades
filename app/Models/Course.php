<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'instructor',
        'created_by',
        'publish_date',
        'expiration_date',
        'status',
        'last_modified_by'
    ];
}
