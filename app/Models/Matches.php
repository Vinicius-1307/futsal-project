<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'teamA_id',
        'teamB_id',
        'result'
    ];

    public function timeA()
    {
        return $this->belongsTo(Team::class, 'teamA_id');
    }

    public function timeB()
    {
        return $this->belongsTo(Team::class, 'teamB_id');
    }
}