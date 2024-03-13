<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->queue_code = self::generateUniqueQueueCode();
        });
    }


    private static function generateUniqueQueueCode()
    {
        do {
            $code = \Illuminate\Support\Str::uuid()->toString(); // Generate UUID
        } while (self::where('queue_code', $code)->exists());

        return $code;
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function requestQueues()
    {
        return $this->hasMany(RequestQueue::class);
    }
    protected function tagId(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function bookmarkedBy()
{
    return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
}

    
}
