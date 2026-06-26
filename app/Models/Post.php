<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'content'])]
class Post extends Model
{
  
    use HasFactory;

    
     // A post belongs to a user.
   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
