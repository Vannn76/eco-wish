<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcoMission extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'mission_date', 'image', 'point_reward'];

    protected $casts = [
        'mission_date' => 'date',
    ];

    public function latestUserSubmission()
{
    return $this->hasOne(MissionSubmission::class, 'mission_id')
        ->where('user_id', auth()->id())
        ->latest();
}

    
    public function submissions()
    {
        return $this->hasMany(MissionSubmission::class, 'mission_id');
    }
}