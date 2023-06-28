<?php

namespace App\Http\Controllers;

use App\Models\PlanesFormacion;
use App\Models\User;
use  PDF;

class PDFController extends Controller
{
    //
    public function pdf($user)
    {
        // $data = Puesto::progresoEmpleados();
        $data = PlanesFormacion::getMatrizByUser($user);
        if(!$data){
            return redirect()->back();
        }
        $data=$data[0];
        $pdf = PDF::loadView('pdfs.prueba', ['data' => $data]);
        $pdf->setOptions(['defaultFont' => 'poppins']);

        // Carga la hoja de estilos CSS para la fuente Poppins
        $css = '@font-face {
            font-family: "poppins";
            src: url("' . public_path('fonts/Poppins-Regular.ttf') . '");
        }';

        $pdf->loadHTML('<style>' . $css . '</style>' . view('pdfs.prueba', ['data' => $data])->render());

        // Devuelve una respuesta PDF en lugar de descargarlo
        return $pdf->stream($data->nombre.".pdf");
    }
}
