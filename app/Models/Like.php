<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class like extends Model
{
    //to use factory 
    use HasFactory;
    //fillable autorise l'enregistrement de user_id et post_id.
    protected $fillable =[
        'user_id',
        'post_id',
    ];
//like belongs to a user and a post (unique combination)
    public function user():BelongsTo{
        return $this->belongsTo(User::class);

    }
    public function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }
    
}
