<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['author_id', 'title', 'content', 'status'];

    public function images(): HasOne{
        return $this->hasOne(Image::class);
    }

    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class);
    }
}
