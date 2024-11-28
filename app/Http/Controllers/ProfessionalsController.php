<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Professionals;
use App\Models\ProfessionalAvailability;
use App\Http\Requests\CollaboratorRequest;
use Illuminate\Support\Facades\Validator;

class ProfessionalsController extends Controller
{
    public function index()
    {
        $id_branch = session()->get('id_branch');
        $all_professional = Professionals::getAllProfessionalByIdBranch($id_branch);
        $all_professional_availability = ProfessionalAvailability::getProfessionalAvailability($id_branch);

        return view('professionals.index', compact('all_professional', 'all_professional_availability'));
    }
    public function save_professional()
    {
        $data = request()->all();
        
        $nombre = $data['name'];
        $apellido = $data['surname'];
        $email = $data['email'];
        $celular = $data['phone'];

        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'surname.required' => 'El campo apellido es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email',
            'phone.required' => 'El campo celular es requerido'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error al guardar un profesional.');
            return redirect()->route('my_professionals');
        }

        if (Professionals::searchProfessionalByEmail($email)) {
            toastr()->error('El email ya está registrado');
            return redirect()->route('my_professionals');
        }

        $professional_information = [
            'id' => Professionals::getNewId(),
            'name' => $nombre,
            'surname' => $apellido,
            'email' => $email,
            'phone' => $celular,
            'branch_id' => session()->get('id_branch'),
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        ];

        if(!Professionals::saveNewProfessional($professional_information)){
            toastr()->error('Error al guardar un profesional.');
            return redirect()->route('my_professionals');
        }

        toastr()->success('Profesional guardado correctamente');
        return redirect()->route('my_professionals');
    }
    public function delete_professional($id_professional){
        if (!preg_match('/^[0-9]+$/', $id_professional)) {
            toastr()->error('El ID del profesional no es válido');
            return redirect()->route('my_professionals');
        }
        
        $professional = Professionals::searchProfessionalById($id_professional);
        if (!$professional) {
            toastr()->error('Profesional no encontrado');
            return redirect()->route('my_professionals');
        }

        $delete_professional = Professionals::deleteProfessionalById($id_professional);
        if(!$delete_professional){
            toastr()->error('Error al eliminar el profesional');    
            return redirect()->route('my_professionals');
        }
        toastr()->success('Profesional eliminado correctamente');
        return redirect()->route('my_professionals');
    }
    public function update_schedules_professional(){
        $esquemas = request()->all();
        dd($esquemas);
        $id_usuario = session()->get('id_usuario');
        $days_of_the_week = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];

        foreach ($esquemas as $dia => $horarios) {
            if($dia == '_token') continue;
            if(!in_array($dia, $days_of_the_week)){
                toastr()->error('El día de la semana no es válido');
                return redirect()->route('my_professionals');
            }
            $data = [
                'collaborator_id' => $id_usuario,
                'day_of_the_week' => $dia,
                'start_time' => $horarios['disponibilidad_inicio'],
                'end_time' => $horarios['disponibilidad_fin'],
                'start_rest_time' => $horarios['descanso_inicio'],
                'end_rest_time' => $horarios['descanso_fin'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            // if(!CollaboratorsAvailability::setCollaboratorAvailability($data)){
            //     toastr()->error('Error al guardar los horarios del colaborador');
            //     return redirect()->route('my_professionals');
            // }
        }
    }
    public function edit_professional($id_professional){
        if (!preg_match('/^[0-9]+$/', $id_professional)) {
            toastr()->error('El ID del profesional no es válido');
            return redirect()->route('my_professionals');
        }

        $professional = Professionals::getProfessionalById($id_professional);

        if (!$professional) {
            toastr()->error('Profesional no encontrado');
            return redirect()->route('my_professionals');
        }

        // dd($professional);
        return view('professionals.edit', compact('professional'));
    }
}