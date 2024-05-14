<!DOCTYPE html>
<html>
<head>
    <style>
         .logo {
            float: right; 
            margin-top: 10px;
            width: 80px; 
            height: auto; 
        }
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }
        .card-photo img {
            width: 200px;
            height: 200px;
            object-fit: cover; 
            margin-bottom: 20px;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
    </header>

    <div style="display: flex;">
        <div style="flex: 1;">
            <h1>Federación Paraguaya de Futbol de Salón</h1>
            <h2>Ficha del Jugador</h2>
                <div class="card">
                <div class="card-photo">
                <img src="{{$record['foto']}}" alt="{{ $record['nombre'] }}" width="300px" height="200px">
                </div>
                <h1>{{ $record['nombre'] }}</h1>
                <p>Nro. de Ficha: {{ $record['ficha'] }}</p>
                <p>Club Actual: {{$record['club']}}</p>
                <p>Estado Ficha : {{ $record['habilitado']}}</p>
                <p>Documento : {{ $record['documento']}}</p>
                <p>Edad: {{ $record['edad'] }} años</p>
                <p>Categoria: {{ $record['categoria'] }}</p>
                <p>Género: {{ $record['sexo']}}</p>
                </div>          
             </div>
        <div style="flex: 1;">
            <h2>Código QR</h2>
            @if (empty($record['url']))
            <p>URL del código QR vacía o no definida.</p>
            @else
            {!! QrCode::size(200)->generate($record['url']) !!}
            @endif
                    
        </div>
    </div>
</body>