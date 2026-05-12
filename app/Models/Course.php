<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    public function createdby():BelongsTo {
            return $this->belongsTo(User::class, 'created_by');
    }



     public function scopeFilter(Builder $query, array $filters):Builder{

        return $query->when(
            $filters['search'] ?? false,
            fn(Builder $query, $value): Builder => $query->where('title','LIKE', "%".$value."%")
            );
            /*
            ->when(
                $filters['priceTo'] ?? false,
                fn(Builder $query, $value): Builder => $query->where('price','<=',$value)
            )
            ->when(
                $filters['beds'] ?? false,
                fn(Builder $query, $value): Builder => $query->where('beds',(int)$value < 6 ? '=' : '>=',$value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn(Builder $query, $value): Builder => $query->where('baths',(int)$value < 6 ? '=' : '>=',$value)
            )
            ->when(
                $filters['areaFrom'] ?? false,
                fn(Builder $query, $value): Builder => $query->where('area','>=',$value)
                )
            ->when(
                $filters['areaTo'] ?? false,
                fn(Builder $query, $value): Builder => $query->where('area','<=',$value)
            )
            ->when(
                $filters['deleted'] ?? false,
                fn(Builder $query, $value): mixed => $query->withTrashed()
            )->when(
                $filters['by'] ?? false,
                fn (Builder $query, $value) =>
                !in_array($value,$this->sortable) ?
                $query : $query->orderBy($value,$filters['order'] ?? 'desc')
            );
            */
    }

}
