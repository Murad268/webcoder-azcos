<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsImages extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function translate() {
        return $this->belongsTo(Settings::class, 'category_id');
    }
}
