<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['beds','baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'];

    protected $sortable = ['beds','baths', 'area','price','created_at','code'];



    public function owner():BelongsTo{
        return $this->belongsTo(\App\Models\User::class,'by_user_id');
    }

    public function images():HasMany{
        return $this->hasMany(ListingImage::class);
    }

    public function offers():HasMany{
        return $this->hasMany(Offer::class, 'listing_id');
    }




    public function scopeMostRecent(Builder $query): Builder{
        return $query->latest('created_at');
    }

    public function scopeFilter(Builder $query, array $filters):Builder{
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn(Builder $query, $value): Builder => $query->where('price','>=',$value)
            )
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
    }

    public function getSortable() : array{

        return $this->sortable;
    }
}
