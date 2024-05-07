
    <div style="display: flex;">
        <div style="flex: 1;">
            <h1>Ficha del Jugador</h1>
            
            <div class="card">
                <div class="card-photo">
                    <img src="{{$record['foto']}}" alt="{{ $record['nombre'] }}" width="300px" height="200px">
                </div>
                <h1>{{ $record['nombre'] }}</h1>
                <p>Nro. de Ficha: {{ $record['ficha'] }}</p>
                <p>Club Actual: {{$record['club']}}</p>
                <p>Documento : {{ $record['documento']}}</p>
            </div>
           
            <p>Edad: {{ $record['edad'] }} años</p>
            <p>Categoria: {{ $record['categoria'] }}</p>
            <p>Género: {{ $record['sexo']}}</p>
            
            <!-- Añade más campos según sea necesario -->
        </div>
        <div style="flex: 1;">
            <h2>Código QR</h2>
            {!! QrCode::size(200)->generate($record['url']) !!}

        </div>
    </div>
