<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Services extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'duration', 'price', 'image'];

    public function User() {}

    // Un servicio puede tener muchas citas
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointments::class);
    }
}
