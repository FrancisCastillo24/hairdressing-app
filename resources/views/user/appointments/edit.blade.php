<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('citas.update', $cita->id) }}" method="post">
        @csrf
        @method('PUT')

        <h3>Introduce la fecha</h3>
        <input type="date" class="form-control" name="appointment_date" id="appointment_date" value="{{ $cita->appointment_date }}" required><br>

        <h3>Introduce el tipo de servicio</h3>
        <select name="service_id" id="service_id" required class="form-select">
            <option value="0">Seleccionar...</option>
            @foreach($services as $service)
            <option value="{{ $service->id }}" {{ $service->id == $cita->service_id ? 'selected' : '' }}>
                {{ $service->name }}
            </option>
            @endforeach
        </select>

        <h3>Introduce la hora de inicio</h3>
        <input type="time" class="form-control" name="start_time" id="start_time" value="{{ $cita->start_time }}" required><br>

        <h3>Introduce la hora de fin</h3>
        <input type="time" class="form-control" name="end_time" id="end_time" value="{{ $cita->end_time }}" required><br>

        <button type="submit" class="btn btn-primary">Actualizar cita</button>
    </form>
    <a href="{{ route('citas.index') }}">Volver</a>

</body>

</html>