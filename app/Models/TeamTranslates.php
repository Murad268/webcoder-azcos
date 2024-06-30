<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
