<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    public $fillable = [
        'title','featured','content','category_id', 'slug', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function getFeaturedAttribute($featured)
    {
    	return asset($featured);
    }
    public function hasTag($tagId)
    {
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
    public function category()

    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user()

    {
        return $this->belongsTo('App\User');
    }
}
