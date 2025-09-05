<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['is_published', 'is_missing', 'is_resolved', 'title', 'description', 'date', 'location', 'species_id', 'breed_id', 'color', 'size', 'name_contact', 'email_contact', 'phone_contact', 'user_id'];

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
        return $this->belongsTo(Breeds::class);
    }
}
