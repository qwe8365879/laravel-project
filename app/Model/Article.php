<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'description'];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function author(){
        return $this->belongsTo(\App\User::class, 'author_id', 'id');
    }

    public static function filter(array $filter){
        $query = (new Article)->newQuery();
        if(!empty($filter)){
            if(array_key_exists('title', $filter)){
                $query->where('title', 'like', '%'.$filter['title'].'%');
            }
            if(array_key_exists('category', $filter)){
                $query->whereHas('categories', function ($query) use ($filter) {
                    if(is_array($filter['category'])){
                        $query->whereIn('categories.id', $filter['category']);
                    }else{
                        $query->where('categories.id', '=', $filter['category']);
                    }
                });
            }
            return $query->get();
        }else{
            return Article::all();
        }
    }
}
