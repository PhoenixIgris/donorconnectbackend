<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function tag(){
        return $this->belongsTo(Tag::class,'tag_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'tag_id');
    }



    
}
