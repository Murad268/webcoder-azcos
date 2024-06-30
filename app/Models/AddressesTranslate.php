<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressesTranslate extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public function translate() {
        return $this->belongsTo(Addresses::class, 'address_id');
    }
}
