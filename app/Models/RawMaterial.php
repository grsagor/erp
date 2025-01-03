<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    public function type() {
        return $this->belongsTo(TypeOfRawMaterial::class, 'type_id');
    }
}
