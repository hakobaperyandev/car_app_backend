<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 
        'price', 
        'year', 
        'engine_id',
        'transmission_id', 
        'exterior_color', 
        'interior_color'
    ];

    public function brand() 
    {
        return $this->belongsTo(Brand::class);
    }

    public function transmission() 
    {
        return $this->belongsTo(Transmission::class);
    }

    public function engine() 
    {
        return $this->belongsTo(Engine::class);
    }
}
