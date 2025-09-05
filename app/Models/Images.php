<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['post_id', 'url', 'alt_text', 'order'];

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
}
