<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollaboratorRequest;
use App\Models\Collaborators;
use App\Models\CollaboratorsAvailability;

class CollaboratorsController extends Controller
{
    public function index()
    {
        $id_branch = session()->get('id_branch');
        $all_collaborators = Collaborators::getAllCollaboratorsByIdBranch($id_branch);
        $all_collaborators_availability = CollaboratorsAvailability::getCollaboratorAvailability($id_branch);
        
        return view('collaborators.index', compact('all_collaborators', 'all_collaborators_availability'));
    }
    public function save_collaborator(CollaboratorRequest $request)
    {
        $data = $request->validated();
        $data['branch_id'] = session()->get('id_branch');
        $data['created_at'] = date('Y-m-d H:i:s');

        if(!Collaborators::saveNewCollaborator($data)){
            toastr()->error('Error al guardar el colaborador');
            return redirect()->route('my_collaborators');
        }

        toastr()->success('Colaborador guardado correctamente');
        return redirect()->route('my_collaborators');
    }
    public function delete_collaborator($id_collaborator){
        if (!preg_match('/^[0-9]+$/', $id_collaborator)) {
            toastr()->error('El ID del colaborador no es válido');
            return redirect()->route('my_collaborators');
        }
        
        $collaborator = Collaborators::searchCollaboratorById($id_collaborator);

        if (!$collaborator) {
            toastr()->error('Colaborador no encontrado');
            return redirect()->route('my_collaborators');
        }

        $collaborator->delete();
        toastr()->success('Colaborador eliminado correctamente');
        return redirect()->route('my_collaborators');
    }
    public function update_collaborator(CollaboratorRequest $request){
        $data = $request->validated();
        $collaborator = Collaborators::searchCollaboratorByEmail($data['email']);

        if (!$collaborator) {
            toastr()->error('Colaborador no encontrado');
            return redirect()->route('my_collaborators');
        }

        $collaborator->name = $data['name'];
        $collaborator->surname = $data['surname'];
        $collaborator->email = $data['email'];
        $collaborator->phone = $data['phone'];
        $collaborator->update_at = date('Y-m-d H:i:s');
        $collaborator->save();

        toastr()->success('Colaborador actualizado correctamente');
        return redirect()->route('my_collaborators');
    }
    public function update_schedules_collaborator(){
        $esquemas = request()->all();
        dd($esquemas);
        $id_usuario = session()->get('id_usuario');
        $days_of_the_week = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];

        foreach ($esquemas as $dia => $horarios) {
            if($dia == '_token') continue;
            if(!in_array($dia, $days_of_the_week)){
                toastr()->error('El día de la semana no es válido');
                return redirect()->route('my_collaborators');
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

            if(!CollaboratorsAvailability::setCollaboratorAvailability($data)){
                toastr()->error('Error al guardar los horarios del colaborador');
                return redirect()->route('my_collaborators');
            }
        }
    }
}