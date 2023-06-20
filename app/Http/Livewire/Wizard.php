<?php

namespace App\Http\Livewire;

use App\Models\Cursos;
use App\Models\Modalidad_cursos;
use App\Models\Tipo_cursos;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Wizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $codigo, $nombre, $fecha_inicio, $fecha_termino, $estado = 1, $modalidad_id, $tipo_curso_id, $interno_planta = 0 , $imagen;
    public $successMessage = '';

    public function render()
    {
        $modalidad = Modalidad_cursos::all();
        $tipo = Tipo_cursos::all();
        return view('livewire.wizard', compact('modalidad', 'tipo'));
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'imagen' => 'required|image',

        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function threeStepSubmit()
    {
        $validatedData = $this->validate([
            'modalidad_id' => 'required',
            'tipo_curso_id' => 'required',
            // 'interno_planta' => 'required',
        ]);

        $this->currentStep = 4;
    }

    public function submitForm()
    {
        $imgCurso = $this->imagen->store('public/imagenes');
        $url = Storage::url($imgCurso);
        
        $curso = Cursos::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_termino' => $this->fecha_termino,
            'modalidad_id' => $this->modalidad_id,
            'tipo_curso_id' => $this->tipo_curso_id,
            'interno_planta' => $this->interno_planta,
            'imagen' => $url ,
            'estado' => $this->estado,
        ]);
        $this->clearForm();

        return to_route("cursos.show",$curso->id_curso)->with('agregado', 'Agregado Correctamente');
        // 36743137
    }

    public function show($id)
    {
        $curso = Cursos::find($id);
        // $autores = User::all();
        return view('admin.cursos.configurarCursos', compact('curso'));
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }


    public function clearForm()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->fecha_inicio = '';
        $this->fecha_termino = '';
        $this->modalidad_id = '';
        $this->tipo_curso_id = '';
        // $this->interno_planta = '';
        $this->estado = '';
    }
}