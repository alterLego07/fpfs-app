<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function downloadJugadores(Jugadores $record)
    {

        $fecha = new DateTime();
        $fecha_nac =  new DateTime($record->fecha_nacimiento);
        $edad = intval($fecha->diff($fecha_nac)->format('%y'));
        $foto = asset("storage/".$record->fotografia);
        $nro_ficha = $record->nro_ficha_anterior;
        $sexo = ($record->sexo == 1) ? 'Masculino': 'Femenino';

        if($record->habilitado == 1){
            $habilitado = 'Habilitado' ;
        }elseif($record->habilitado == 2){
            $habilitado = 'Inhabilitado' ;
        }else{
            $habilitado = 'Libre' ;
        }

        // Generar el código QR
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate(url()->current()));

        $datos = [
            'nombre' => $record->apellido_jugador.', '.$record->nombre_jugador,
            'foto' => $foto,
            'edad' => $edad,
            'categoria' => $record->categoria->descripcion,
            'nro_ficha' => $nro_ficha,
            'club' => $record->club->nombre_club,
            'documento' => $record->documento,
            'ficha'=> $nro_ficha,
            'sexo' => $sexo,
            'habilitado' => $habilitado,
            'qrcode' => $qrcode,
        ];



        $nombre_pdf = $nro_ficha.'.pdf';

        $pdf = Pdf::loadView('jugadores.pdf.download', ['record' => $datos]);
        return $pdf->download($nombre_pdf);
    }
}
