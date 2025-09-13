<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    //
    use SoftDeletes, HasFactory;
    protected $fillable = ['is_published', 'is_missing', 'is_resolved', 'title', 'description', 'date', 'location', 'species_id', 'breed_id', 'color', 'size', 'name_contact', 'email_contact', 'phone_contact', 'user_id', 'slug', 'images'];

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

    public function reports()
    {
        return $this->hasMany(Reports::class, 'post_id');
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


    protected $casts = [
        'images' => 'array',
        'date' => 'date',
    ];
}
