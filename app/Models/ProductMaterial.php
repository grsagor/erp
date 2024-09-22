<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    use HasFactory;

    public function material_type() {
        return $this->belongsTo(TypeOfRawMaterial::class, 'material_id');
    }
}
