<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','parent'
    ];

    public function getParent(){
        return $this->belongsTo(Category::class, 'parent', 'id');
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    public function filter(array $filters){

    }
}
