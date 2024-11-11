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
        // Mando al formulario los datos almacenados de servicio (corte de pelo) y el usuario conectado en ese momento para mostrar los datos justo debajo mando las citas
        $user = Auth::id();
        $citas = Appointments::where('user_id', $user)->get();
        $services = Services::all();
        return view('user.appointments.index', ['citas' => $citas, 'services' => $services]);
    }
    // Almaceno las citas
    public function store(Request $request)
    {
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

    public function edit($id)
    {
        $user = Auth::id();
        $citaModificar = Appointments::where('id', $id)->where('user_id', $user)->first();
        $servicioModificar = Services::all();
        return view('user.appointments.edit', ['cita' => $citaModificar, 'services' => $servicioModificar]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $cita = Appointments::findOrFail($request->id); // Usar findOrFail para lanzar una excepción si no se encuentra

        // Actualizar los atributos de la cita
        $cita->service_id = $request->service_id;
        $cita->appointment_date = $request->appointment_date;
        $cita->start_time = $request->start_time;
        $cita->end_time = $request->end_time;

        $cita->save();

        return redirect()->route('citas.delete')->with('success', 'Cita modificada con éxito');
    }

    public function destroy($id)
    {
        $user = Auth::id();
        $citaUsuario = Appointments::where('id', $id)->where('user_id', $user)->first();
        $citaUsuario->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada con éxito');
    }
}
