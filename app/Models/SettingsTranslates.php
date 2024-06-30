<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsTranslates extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public function translate() {
        return $this->belongsTo(Settings::class, 'address_id');
    }
}
