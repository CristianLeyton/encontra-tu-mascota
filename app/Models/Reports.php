<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reports extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['post_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
