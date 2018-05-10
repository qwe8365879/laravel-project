<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title', 'description'];

    public function author(){
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
}
