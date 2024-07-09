<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}
