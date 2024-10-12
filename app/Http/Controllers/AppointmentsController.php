<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Esta línea es para obtener los usuarios

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
        // Verificamos si el usuario está autenticado (modo demo)
        if (!Auth::check()) {
            return redirect()->route("login");
        }
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);


        // dd($request->all());
        // Crear la cita, incluyendo el user_id
        Appointments::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id, // Almacenar el ID del servicio
            'appointment_date' => $request->appointment_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pendiente', // Asigna un estado por defecto si es necesario
        ]);


        return redirect()->route('citas.index')->with('success', 'Cita creada con éxito');
    }
}
