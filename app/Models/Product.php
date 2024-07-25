<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'description', 'price'];

    public $translatable = ['name', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function withStocks($stock_id)
    {
        $this->stocks = [$this->stocks()->findOrFail($stock_id)];
        return $this;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function getDiscount()
    {
        if ($this->discount) {
            if ($this->discount->from === null && $this->discount->to === null) {
                return $this->discount;
            }
            if (Carbon::now()->between(Carbon::parse($this->discount->from), Carbon::parse($this->discount->to))) {
                return $this->discount;
            }
        }
    }
}
