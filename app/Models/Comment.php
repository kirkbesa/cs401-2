<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    // Relationships
    // One comment has Many Comments (replies)
        // Parent comment
    public function comment(): BelongsTo 
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }
        // Child comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // One comment belongs to One Post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    // One comment belongs to One User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
