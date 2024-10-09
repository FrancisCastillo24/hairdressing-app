<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    // Almaceno los servicios del formulario
    public function store(Request $request)
    {
        // Validamos los campos
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:10000'
        ]);

        // Inicializamos los datos para crear el nuevo registro
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'image' => null // Inicialmente, sin foto
        ];

        // Si hay una foto en la solicitud, la almacenamos
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        // Creamos los datos para almacenarlo en la base de datos
        Services::create($data);

        return redirect()->route('services.index')->with('success', 'Servicio creado con éxito');
    }
}
