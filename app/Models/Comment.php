<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        
    ];

    protected $casts = [
        'body' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'comment_id');
    }
}
