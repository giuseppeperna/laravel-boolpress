<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ["title", "user_id", "category_id", 'image_path'];

    public function postInfo() {
        return $this->hasOne('App\PostInformation', 'post_id', 'id');
    }

    public function categories() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany("App\Tag", "post_tag", "post_id", "tag_id");
    }

    public function users() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
