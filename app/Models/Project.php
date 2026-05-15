<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title'

    ];



    public function courses():HasMany {
        return $this->hasMany(Course::class, 'project_id');
    }

    public function created_by():BelongsTo {
        return $this->BelongsTo(User::class, 'created_by');
    }

    public function scopeGetProjects(Builder $query): Builder
    {
        return $query;
    }

}
