<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROGRAMA TU CITA CON NOSOTROS') }}
        </h2>
    </x-slot>

    <!-- Formulario adaptado al mismo estilo del contenedor de la tabla -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form class="row g-3" action="{{ route('citas.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="appointment_date" class="form-label">Fecha Cita</label>
                            <input type="date" class="form-control" name="appointment_date" id="appointment_date" required>
                        </div>

                        <div class="col-md-6">
                            <label for="service_id" class="form-label">Selecciona un servicio:</label>
                            <select name="service_id" id="service_id" required class="form-select">
                                <option value="0" selected>Seleccionar...</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="start_time" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" name="start_time" id="start_time" required>
                        </div>

                        <div class="col-md-6">
                            <label for="end_time" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" name="end_time" id="end_time" required>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Programar Cita</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-striped">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha Cita</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        @foreach ($citas as $cita)
                        <tr>
                            <td>{{$cita->user->name}}</td>
                            <td>{{$cita->appointment_date}}</td>
                            <td>{{$cita->start_time}}</td>
                            <td>{{$cita->end_time}}</td>
                            <td>{{$cita->status}}</td>
                            <td>
                                <form action="{{ route('citas.destroy', $cita->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancelar cita</button>
                                <a href="{{ route('citas.edit', $cita) }}" class="btn btn-dark">Cambiar cita</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>