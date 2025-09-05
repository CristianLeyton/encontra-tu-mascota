<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breeds extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['species_id', 'name'];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }
}
