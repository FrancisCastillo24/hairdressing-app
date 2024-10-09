<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Services;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        // Mando al formulario los datos almacenados de servicio (corte de pelo) y para mostrar los datos justo debajo mando las citas
        $citas = Appointments::all();
        $services = Services::all();
        return view('user.appointments.index', ['citas' => $citas, 'services' => $services]);
    }
    // Almaceno las citas
    public function store(Request $request)
    {
        // Validamos los campos
        $request->validate([
            'appointment_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        Appointments::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Cita creada con éxito');
    }
}
