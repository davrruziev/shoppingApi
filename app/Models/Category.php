<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [ 'parent_id', 'name', 'icon', 'order'];

    public $translatable = ['name'];

    public function products()
    {
       return $this->hasMany(Product::class);
    }

    public function childCategories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
