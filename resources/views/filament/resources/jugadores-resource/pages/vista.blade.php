<x-filament::page>



    @php 
        $fecha = new DateTime();
        $fecha_nac =  new DateTime($record->fecha_nacimiento);
        $edad = intval($fecha->diff($fecha_nac)->format('%y'));
        $foto = asset("storage/".$record->fotografia);
        $categoria = ( $edad > 18 ? 'PRIMERA' : 'C'.$edad);

    @endphp
    
    <div style="display: flex;">
        <div style="flex: 1;">
            <h1>Ficha del Jugador</h1>
            
            <div class="card">
                <div class="card-photo">
                    {{-- <div class="card" style="border: 5px solid #ccc; padding:10px; margin:10px; width=300px !important;"> --}}
                    <img src="{{$foto}}" alt="{{ $record->nombre_jugador }}" width="300px" height="200px">
                </div>
                <h1>{{ $record->apellido_jugador }}, {{ $record->nombre_jugador }}</h1>
                <p>Nro. de Ficha: {{ $record->nro_ficha_anterior }}</p>
                <p>Documento : {{ $record->documento}}</p>
            </div>
           
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