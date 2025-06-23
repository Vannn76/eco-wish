<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcoLearnContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'video_url',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'eco_learn_content_id')->whereNull('parent_id')->latest();
    }
    public function allComments()
    {
        return $this->hasMany(Comment::class, 'eco_learn_content_id')->latest();
    }


}