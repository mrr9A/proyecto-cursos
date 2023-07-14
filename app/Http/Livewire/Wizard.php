<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Categoria_curso;
use App\Models\Curso;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Wizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $codigo, $nombre, $cursO_id,
        $estado = 1, $categoria_id, $modalidad_id, $tipo_curso_id,
        $interno_planta = 1, $imagen;
    public $successMessage = '';

    public function render()
    {
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        $categoria = Categoria::all();
        return view('livewire.wizard', compact('modalidad', 'tipo', 'categoria'));
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'codigo' => 'required|string|min:5 |unique:cursos',
            'nombre' => 'required|string|min:5,max:45|unique:cursos',
            'imagen' => 'required|image|mimes:jpg,png',
            'modalidad_id' => 'required',
            'tipo_curso_id' => 'required',
            'categoria_id' => 'required',
        ]);

        $this->currentStep = 2;
    }


    public function messages()
    {
        return [
            // VALIDACION DE CODIGO
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.string' => 'El campo codigo debe ser una cadena.',
            'codigo.min' => 'El campo codigo debe ser minimo 5 caracteres.',
            'codigo.unique' => 'El campo codigo es unico.',
            // VALIDACION DE NOMBRE
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena.',
            'nombre.min' => 'El campo nombre debe ser minimo 5 caracteres.',
            // VALIDACION DE IMAGEN
            'imagen.required' => 'El campo imagen es obligatorio.',
            'imagen.image' => 'El campo imagen debe ser formato png,jpg.',
            'imagen.mimes' => 'El campo imagen debe ser formato png,jpg.',
            // VALIDACION DE MODALIDAD DEL CURSO
            'modalidad_id.required' => 'El campo Modalidad termino es obligatorio.',
            // VALIDACION DE TIPO CURSO
            'tipo_curso_id.required' => 'El campo Tipo termino es obligatorio.',
            // VALIDACION DE CATEGORIA CURSO
            'categoria_id.required' => 'El campo Categoria termino es obligatorio.',

        ];
    }

    public function submitForm()
    {

        DB::transaction(function () {

            $imgCurso = $this->imagen->store('public/imagenes');
            $url = Storage::url($imgCurso);

            $curso = Curso::create([
                'codigo' => $this->codigo,
                'nombre' => $this->nombre,
                'modalidad_id' => $this->modalidad_id,
                'tipo_curso_id' => $this->tipo_curso_id,
                'interno_planta' => $this->interno_planta,
                'imagen' => $url,
                'estado' => $this->estado,
            ]);

            $this->cursO_id = $curso->id_curso;

            Categoria_curso::create([
                'categoria_id' => $this->categoria_id,
                'curso_id' => $curso->id_curso

            ]);
        });
        $this->clearForm();

        return to_route("curs.show", $this->cursO_id)->with('agregado', 'Agregado Correctamente');
    }

    public function show($id)
    {
        $curso = Curso::find($id);
        // $autores = User::all();
        return view('admin.curs.configurarCursos', compact('curso'));
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }


    public function clearForm()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->modalidad_id = '';
        $this->tipo_curso_id = '';
        // $this->interno_planta = '';
        $this->estado = '';
    }
}
