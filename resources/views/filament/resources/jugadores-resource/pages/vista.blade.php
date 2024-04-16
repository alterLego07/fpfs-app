<x-filament::page>



    @php 
        $fecha = new DateTime();
        $fecha_nac =  new DateTime($record->fecha_nacimiento);
        $edad = intval($fecha->diff($fecha_nac)->format('%y'));
        // dd(var_dump($edad));
        // dd(asset('images/'.$record->fotografia));
        $categoria = ( $edad > 18 ? 'PRIMERA' : 'C'.$edad);

    @endphp
    
    <div style="display: flex;">
        <div style="flex: 1;">
            <h1>Ficha del Jugador</h1>
            
            <div class="card">
                <img src="{{asset($record->fotografia) }}" alt="Foto de {{ $record->nombre_jugador }}">
                <p>Nro. de Ficha: {{ $record->nro_ficha_anterior }}</p>
            </div>
            <h2>{{ $record->apellido_jugador }}, {{ $record->nombre_jugador }}</h2>
            <p>Edad: {{ $edad }} años</p>
            <p>Categoria: {{ $categoria }}</p>
            <p>Género: {{ ($record->sexo == 1) ? 'Masculino': 'Femenino'}}</p>
            
            <!-- Añade más campos según sea necesario -->
        </div>
        <div style="flex: 1;">
            <h2>Código QR</h2>
            {!! QrCode::size(200)->generate(url()->current()) !!}

        </div>
    </div>
</x-filament::page>