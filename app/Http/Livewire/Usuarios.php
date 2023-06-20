<?php

namespace App\Http\Livewire;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\Sucursales;
use App\Models\Sucursales_Usuarios;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Usuarios extends Component
{
    public $currentStep = 1;
    public $nombre,$trabajos =[], $segundo_nombre, $apellido_paterno, $apellido_materno, $id_sgp, $id_sumtotal, $email, $password, $estado = 1, $rol, $puesto_id, $sucursal_id, $usuario_id , $fecha_alta_planta , $fecha_ingreso_puesto;
    public $successMessage = '';

    public function render()
    {
        $sucursal = Sucursal::all();
        $puesto = Puesto::all();
        return view('livewire.usuarios', compact('sucursal', 'puesto'));
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'nombre' => 'required',
            'segundo_nombre' => 'nullable|string',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'nullable|string'

        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $this->currentStep = 3;
    }

    public function threeStepSubmit()
    {
        $validatedData = $this->validate([
            'id_sgp' => 'required',
            'id_sumtotal' => 'required',
            'rol' => 'required',
            'sucursal_id' => 'required',
            'puesto_id' => 'required',
            'trabajos' => 'array',
            'fecha_alta_planta' => 'nullable|date',
            'fecha_ingreso_puesto' => 'nullable|date'
        ]);

        $this->currentStep = 4;
    }

    public function submitForm()
    {

        $data = [
            'nombre' => $this->nombre,
            'segundo_nombre' => $this->segundo_nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'email' => $this->email,
            'password' => $this->password,
            'rol' => $this->rol,
            'puesto_id' => $this->puesto_id,
            'id_sgp' => $this->id_sgp,
            'id_sumtotal' => $this->id_sumtotal,
            'estado' => $this->estado,
            'fecha_alta_planta' => $this->fecha_alta_planta,
            'fecha_ingreso_puesto' =>$this->fecha_ingreso_puesto
        ];

        // $response = Http::post('usuarios.store', ['data' => $data]);

        DB::transaction(function () use($data){
            $usuario = User::create($data);
        });

        $this->successMessage = 'Usuario Creado Correctamente.';

        $this->clearForm();

        return redirect('usuarios')->with('agregado', 'Agregado Correctamente');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->nombre = '';
        $this->segundo_nombre = '';
        $this->apellido_paterno = '';
        $this->apellido_materno = '';
        $this->email = '';
        $this->password = '';
        $this->estado = 1;
        $this->rol = '';
        $this->sucursal_id = '';
        $this->puesto_id = '';
        $this->fecha_alta_planta = '';
        $this->fecha_ingreso_puesto = '';
    }
}
