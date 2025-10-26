<?php

namespace App\Models;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable=[
        'title',
        'content',
        'image',
        'user_id',
        'category_id',
        'status'
    ];

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }
    public function views(): HasMany{
        return $this->hasMany(Views::class);
    }
}
