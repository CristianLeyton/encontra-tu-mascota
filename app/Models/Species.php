<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name', 'icon'];
    public function breeds()
    {
        return $this->hasMany(Breeds::class, 'species_id');
    }
}
