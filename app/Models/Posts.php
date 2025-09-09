<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Posts extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['is_published', 'is_missing', 'is_resolved', 'title', 'description', 'date', 'location', 'species_id', 'breed_id', 'color', 'size', 'name_contact', 'email_contact', 'phone_contact', 'user_id', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function species()
    {
        return $this->belongsTo(Species::class);
    }
    public function breed()
    {
        return $this->belongsTo(Breeds::class, 'breed_id');
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->title);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->title);
        });
    }
}
