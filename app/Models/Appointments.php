<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'appointment_date', 'start_time', 'end_time', 'status'];

    // Cada cita pertenece a un único usuario y un usuario puede tener muchas citas
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
