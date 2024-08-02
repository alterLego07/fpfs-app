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
            position: relative;
        }
        .card-photo {
            position: absolute;
            top: 20px;
            right: 20px;
            border: 2px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-photo img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .card-details {
            margin-right: 240px; 
        }
        .highlight {
            font-weight: bold;
            color: #007BFF; /* Color destacado */
        }
        .hr-line {
            border: none;
            border-top: 2px solid #007BFF; /* Color de la línea */
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .qr-code {
            margin-top: 20px;
            text-align: center;
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
            <h3>Ficha de Habilitación del Jugador</h3>
            <div class="card">
                <div class="card-photo">
                    <img src="{{ $record['foto'] }}" alt="{{ $record['nombre'] }}">
                </div>
                <div class="card-details">
                    <h2>{{ $record['nombre'] }}</h2>
                    <p>Nro. de Ficha: {{ $record['ficha'] }}</p>
                    <p>Club Primer Fichaje: {{ $record['club_primer_fichaje'] }}</p>
                    <p>Estado Ficha: {{ $record['habilitado'] }}</p>
                    <p>Documento: {{ number_format($record['documento'], 0, ',', '.') }}</p>
                    <p>Fecha de Nacimiento: {{ \Carbon\Carbon::parse($record['fecha_nacimiento'])->format('d/m/Y') }}</p>
                    <p>Edad: {{ $record['edad'] }} años</p>
                    <p>Categoria: {{ $record['categoria'] }}</p>
                    <p>Género: {{ $record['sexo'] }}</p>
                    <hr class="hr-line">
                    <p class="highlight">Club Actual: {{ $record['club'] }}</p>
                </div>
            </div>
        </div>
        <div style="flex: 1;">
            <h2>Código QR</h2>
            <div class="qr-code">
                <img src="data:image/png;base64, {!! $record['qrcode'] !!}" title="Codigo QR">
                <p style="margin-top: 10px;">
                    Fecha y hora de creación: {{ now()->format('d/m/Y') }} | {{ now()->format('H:i:s') }}
                </p>
            </div>
        </div>
    </div>
</body>
</html>


