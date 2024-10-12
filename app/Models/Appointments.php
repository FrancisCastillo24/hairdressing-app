<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'appointment_date', 'start_time', 'end_time', 'status', 'service_id'];

    // Cada cita pertenece a un único usuario y un usuario puede tener muchas citas
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Una cita pertenece a un único servicio
    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class);
    }
}
