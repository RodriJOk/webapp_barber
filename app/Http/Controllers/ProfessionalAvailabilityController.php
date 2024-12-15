<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ProfessionalAvailability;
use App\Models\Professionals;

class ProfessionalAvailabilityController extends Controller
{
    public function my_professionals_availability($id)
    {
        $professional_information = Professionals::getProfessionalById($id);
        if(!$professional_information){
            toastr()->error('El profesional no existe');
            return redirect()->route('my_professionals');
        }
        $professional_availability = ProfessionalAvailability::getProfessionalAvailability($id);
        $data = [];

        if(!$professional_availability){
            return view('professional_availability.my_professionals_availability', compact('data', 'professional_information'));
        }

        foreach ($professional_availability as $availability) {
            $data[] = [
                'day_of_the_week' => $availability->day_of_the_week,
                'start_time' => $availability->start_time,
                'end_time' => $availability->end_time,
                'start_rest_time' => $availability->rest_start_time,
                'end_rest_time' => $availability->rest_end_time,
                'active' => $availability->active,
            ];
        }

        return view('professional_availability.my_professionals_availability', compact('data', 'professional_information'));
    }
    public function save_professional_availability()
    {
        $data = request()->all();

        $rules = [
            'professional_id' => 'required|regex:/^[0-9]+$/',
            'availability' => 'required',
        ];
        $messages = [
            'professional_id.required' => 'El id del profesional es requerido',
            'professional_id.regex' => 'El id del profesional debe ser un valor numérico',
            'availability.required' => 'La disponibilidad del profesional es requerida',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados');
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $professional_id = request('professional_id');
        $professional_availability = request('availability');

        $update_professional = ProfessionalAvailability::updateProfessionalAvailability($professional_id, $professional_availability);
        
        if(!$update_professional){
            toastr()->error('Error al actualizar la disponibilidad del profesional');
            return redirect()->route('my_professionals_availability', ['id' => $professional_id]);
        }

        toastr()->success('Disponibilidad actualizada correctamente');
        return redirect()->route('my_professionals');
    }
}