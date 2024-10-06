<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $citas = Appointments::all();
        return view('admin.appointments.index', ['citas' =>$citas]);
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
