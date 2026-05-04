<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'instructor',
    ];


    public function Course():BelongsTo{
        return $this->belongsTo(User::class, 'created_by');
    }
}
