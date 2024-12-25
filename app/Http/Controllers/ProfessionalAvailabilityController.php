<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ProfessionalAvailability;
use App\Models\Professionals;
use Illuminate\Support\Facades\Auth;

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

        $professional_email = Professionals::getProfessionalEmailById($id);
        $mostrar_boton_notificaciones = ""; 
        if(Auth::user()->email != $professional_email){
            $mostrar_boton_notificaciones = true;
        }

        return view('professional_availability.my_professionals_availability', compact('data', 'professional_information', 'mostrar_boton_notificaciones'));
    }
    public function store_professional_availability(){
        $data = request()->all();

        $rules = [
            'professional_id' => 'required|integer',
            'availability' => 'required',
            'notification' => 'in:off,on',
        ];        
        $messages = [
            'professional_id.required' => 'El id del profesional es requerido',
            'professional_id.regex' => 'El id del profesional debe ser un valor numérico',
            'availability.required' => 'La disponibilidad del profesional es requerida',
            'notification.required' => 'La notificación es requerida',
            'notification.regex' => 'La notificación debe ser un valor on u off',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados');
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $professional_id = request('professional_id');
        $professional_availability = request('availability');
        $notification = request('notification');

        $update_professional = ProfessionalAvailability::updateProfessionalAvailability($professional_id, $professional_availability);
        if(!$update_professional){
            toastr()->error('Error al actualizar la disponibilidad del profesional');
            return redirect()->route('my_professionals_availability', ['id' => $professional_id]);
        }

        if($notification == 'on'){
            $professional_email = Professionals::getProfessionalEmailById($professional_id);
            $professional_name = Professionals::getProfessionalNameById($professional_id);
            $email = $professional_email->email;
            $name = $professional_name->name . ' ' . $professional_name->surname;
            $subject = 'Notificación de disponibilidad';
            $data = [
                'subject' => $subject,
                'date' => date('Y-m-d H:i:s'),
                'name' => $name,
                'email' => $email,
                'link' => route('index'),
            ];
            $send_email = Mail::to($email)->send(new myEmail($data, 'mail.notificacion_horarios'));
            if(!$send_email){
                toastr()->error('Error al enviar la notificación por correo');
                return redirect()->route('my_professionals_availability', ['id' => $professional_id]);
            }

            toastr()->success('Disponibilidad actualizada correctamente');
        }

        toastr()->success('Disponibilidad actualizada correctamente');
        return redirect()->route('my_professionals');
    }
}