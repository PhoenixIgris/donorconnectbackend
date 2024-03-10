<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQueue extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'user_id', 'position', 'queue_code', 'status'];

    
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

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
