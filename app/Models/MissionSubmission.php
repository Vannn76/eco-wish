<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mission_id', 'photo', 'caption', 'status', 'point_awarded', 'submitted_at'];

    public function mission()
    {
        return $this->belongsTo(EcoMission::class, 'mission_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}