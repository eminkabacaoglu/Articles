<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->hasMany(Article::class); //foreign key
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'category_followers');
    }

    public function isFollowedBy($userid)
    {
        return $this->followers()->where('users.id', $userid)->exists();
    }

    
}
