<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CITAS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-striped">
                        <tr>
                            <th>Cliente</th>
                            <th>Fecha Cita</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Estado</th>
                        </tr>
                        @foreach ($citas as $cita)
                        <tr>
                            <td>{{$cita->user->name}}</td>
                            <td>{{$cita->appointment_date}}</td>
                            <td>{{$cita->start_time}}</td>
                            <td>{{$cita->end_time}}</td>
                            <td>{{$cita->status}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>