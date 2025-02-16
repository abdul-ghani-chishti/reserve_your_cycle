<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleInfo extends Model
{
    use HasFactory;

    public function cycle_images()
    {
        return $this->hasMany(CycleImage::class, 'cycle_id');
    }

    public function cycle_availabilities()
    {
        return $this->hasMany(CycleAvailability::class,'cycle_id');
    }
}
