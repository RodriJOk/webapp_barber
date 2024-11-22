<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Professionals;
use App\Models\ProfessionalServices;
use App\Models\ProfessionalAvailability;
use App\Models\ShiftReservation;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class CalendarController extends Controller
{
    /**
     * ======================================================================
     * Index
     * ======================================================================
     * Is a function that returns the view to show all the reservations in a calendar. 
     **/
    public function index(){
        $get_all_reservations = Calendar::getAllReservations();
        return view('calendar/index', ['reservations' => $get_all_reservations]);
    }
    /**
     * ======================================================================
     * New event
     * ======================================================================
     * Is a function that returns the view to create a new event
     **/
    public function new_event(){
        $id_branch = session('id_branch');
        $professionals = Professionals::getProfessionalsById($id_branch);
        return view('calendar/new_event', ['professionals' => $professionals]);
    }
    /**
     * ======================================================================
     * Create event
     * ======================================================================
     * Receives the data from new_event function and validates it
     **/
    public function create_event()
    {
        //Validaciones de los datos que llegan 
        $validated = request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'day' => 'required',
            'time' => 'required',
            'professional' => 'required',
            'service' => 'required'
        ]);

        //En el caso de que haya un error en la validación, se redirige a la vista anterior
        if (!$validated) {
            return redirect()->back()->withInput();
        }

        $model = new Calendar();   
        $nombre = request()->name;
        $apellido = request()->surname;
        $email = request()->email;
        $fecha_reserva = request()->day;
        $hora_reserva = request()->time;
        $id_professional = request()->professional;
        $id_service = request()->service;
        $phone = request()->phone;

        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'date' => $fecha_reserva,
            'time' => $hora_reserva,
            'observations' => "No hay observaciones",
            'id_user' => request()->session()->get('id_usuario'),
            'created_at' => Carbon::now(),
            'updated_at' => null,
            'id_professional' => $id_professional,
            'id_service' => $id_service,
            'id_branch' => request()->session()->get('id_branch')
        ];

        $shift_reservation_model = $model::createShiftReservation($data);
        if ($shift_reservation_model) {
            toastr()->success('Reserva creada correctamente');
            return redirect('/my_calendar');
        } else {
            toastr()->error('Error al crear la reserva');
            return redirect('/my_calendar');
        } 
    }
    /**
     * ======================================================================
     * Delete event
     * ======================================================================
     * Is a function that deletes an event in the calendar
     **/
    public function delete_event(){
        $data = request()->all();
        $fecha = $data['fecha_reserva'];
        $hora = $data['hora_reserva'];
        $search_event = Calendar::serchShiftReservation(['fecha_reserva' => $fecha, 'hora_reserva' => $hora, 'id_usuario' => session('id_usuario')]);
        if($search_event){
            $search_event->delete();
            toastr()->success('Reserva eliminada correctamente');
            return redirect('/my_calendar');
        }else{
            toastr()->error('Error al eliminar la reserva');
            return redirect('/my_calendar');
        }
    }
    public function get_services_by_professional(){
        $id_professional = (int)request()->id_professional;
        $services = ProfessionalServices::getServicesByProfessional($id_professional);
        return response()->json($services);
    }
    public function get_availability_day(){
        $id_professional = (int)request()->id_professional;
        $services = (int)request()->services;
        $date = request()->date;
        // $id_professional = 1;
        // $services = 1;
        // $date = '2024-11-22';
        $get_days_availability = ProfessionalAvailability::getDaysByProfessional($id_professional);
        $get_reservation = ShiftReservation::getRervationByProfessional($id_professional, $date);

        $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        $num_days = 7; 
        $availability_by_day = [];

        for ($i = 0; $i < $num_days; $i++) {
            $currentDate = date('Y-m-d', strtotime($date . " +$i days"));
            $currentDayIndex = date('N', strtotime($currentDate)) - 1; // Índice basado en 0
            $currentDayName = $days[$currentDayIndex];

            // Filtrar disponibilidad por día
            $dayAvailability = array_filter($get_days_availability, function ($day_availability) use ($currentDayName) {
                return $day_availability->day_of_the_week == $currentDayName;
            });

            // Generar horarios disponibles para el día
            if (!empty($dayAvailability)) {
                $startTime;
                $endTime;
                foreach ($dayAvailability as $key => $value) {
                    $dayAvailability[$key]->start_time = date('H:i', strtotime($value->start_time));
                    $dayAvailability[$key]->end_time = date('H:i', strtotime($value->end_time));
                    
                    $startTime = new DateTime($dayAvailability[$key]->start_time); // Hora de inicio
                    $endTime = new DateTime($dayAvailability[$key]->end_time);     // Hora de fin
                }
                $interval = new DateInterval('PT30M');           // Intervalos de 30 minutos

                if($get_reservation == null){
                    $reservations = [];
                }else{
                    $reservations = $get_reservation->filter(function ($reservation) use ($currentDate) {
                        return $reservation->date == $currentDate;
                    })->pluck('time')->map(function ($time) {
                        return date('H:i', strtotime($time));
                    })->toArray();
                }

                // Calcular los turnos disponibles. Tomar la fecha y la hora actual, para evitar los turnos pasados.
                $currentDateTime = Carbon::now('America/Argentina/Buenos_Aires')->format('Y-m-d H:i');
                $hora_fecha_actual = Carbon::parse($currentDateTime)->format('H:i');
                $dia_fecha_actual = Carbon::parse($currentDateTime)->format('Y-m-d');

                $availableSlots = [];
                while ($startTime < $endTime) {
                    $slot = $startTime->format('H:i');
                    if($startTime < $hora_fecha_actual && $currentDate <= $dia_fecha_actual){
                        $startTime->add($interval);
                        continue;
                    }
                    
                    if (!in_array($slot, $reservations)) {
                        $availableSlots[] = [
                            'hora' => $slot,
                            'dia' => $currentDate
                        ];
                    }
                    $startTime->add($interval);
                }

                $availability_by_day[] = [
                    'date' => ucfirst(Carbon::parse($currentDate)->translatedFormat('l d \d\e F')),
                    'availableSlots' => $availableSlots,
                ];
            }
        }

        return response()->json(
            ['availability' => $get_days_availability, 
             'id_professional' => $id_professional,
             'services' => $services,
             'date' => $date,
             'availability_by_day' => $availability_by_day
        ]);
    }
}