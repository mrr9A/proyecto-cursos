<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamenController extends Controller
{

    public function store(Request $request)
    {
        dd($request->all());
        return $request->all();
        // $data = $request->except('_token', 'nombre', "contenido_id");
        // $keys = array_keys($data);


        // // dd($keys);
        // // dd ($request->all());

        // $i = 0;
        // while($i < count($keys) /2){
        //     $preguntas = [
        //         "pregunta" => $data[$keys[$i]],
        //         "opciones" => $data[$keys[++$i]],
        //         "respuesta" => $data[$keys[++$i]]
        //     ];

        //     echo "<script>console.log(".json_encode($preguntas).")</script>";   
        //     ++$i;
        //     // echo "<script>console.log(".json_encode($data[$keys[$i]]).")</script>";   
        // }
        // dd($keys);
        // dd ($request->all());
        // // $examen = new Examen();
        // // $examen->nombre = $request->input('nombre');
        // // // $examen->save();
        // // $preguntas = [];

        // // foreach ($request->except('_token', 'nombre') as $key => $value) {

        // // }

        // // dd($request->all());
        // $examen = new Examen();
        // $examen->nombre = $request->input('nombre');
        // $examen->leccion_id = $request->input('contenido_id');
        // // $examen->save();
        // return $examen;
        // $createMultiplePregunt = [
        //     ['pregunta' =>$request->input('pregunta'), 'email' => 'Cursosinternos@techvblogs.com', 'password' => bcrypt('TechvBlogs@123')]
        // ];

        // Preguntas::insert($createMultiplePregunt); // Eloquent
        // DB::table('users')->insert($createMultiplePregunt); // Query Builder
    }


    public function show(string $id)
    {
        return view('Cursosinternos.examenes.examen', compact('id'));
    }
}
