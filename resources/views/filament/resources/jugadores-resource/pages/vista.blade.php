<x-filament::page>
    
    {{-- {{dd($record->fotografia);}} --}}

    
    <div style="display: flex;">
        <div style="flex: 1;">
            <h1>Perfil de Usuario</h1>
            <img src="{{asset($record->fotografia) }}" alt="Foto de {{ $record->nombre_jugador }}">
           {{--  <h2>{{ $usuario->nombre }}</h2>
            <p>Correo Electrónico: {{ $usuario->correo }}</p>
            <p>Edad: {{ $usuario->edad }}</p>
            <p>Género: {{ $usuario->genero }}</p> --}}
            <!-- Añade más campos según sea necesario -->
        </div>
        <div style="flex: 1;">
            <h2>Código QR</h2>
            {!! QrCode::size(200)->generate(url()->current()) !!}

        </div>
    </div>
</x-filament::page>