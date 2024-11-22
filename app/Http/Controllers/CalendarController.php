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
    public function index(){
        $get_all_reservations = Calendar::getAllReservations();
        return view('calendar/index', ['reservations' => $get_all_reservations]);
    }
    public function new_event(){
        $id_branch = session('id_branch');
        $professionals = Professionals::getProfessionalsById($id_branch);
        return view('calendar/new_event', ['professionals' => $professionals]);
    }
    public function create_event()
    {
        dd(request()->all());
        $model = new Calendar();
        $nombre = request()->nombre;
        $apellido = request()->apellido;
        $fecha_reserva = request()->fecha_reserva;
        $hora_reserva = request()->hora_reserva;
        $id_usuario = request()->session()->get('id_usuario');
        $observacion = request()->observaciones_reserva;
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'fecha_reserva' => $fecha_reserva,
            'hora_reserva' => $hora_reserva,
            'observaciones_reserva' => $observacion,
            'id_usuario' => $id_usuario
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
        // $id_professional = (int)request()->id_professional;
        // $services = (int)request()->services;
        // $date = request()->date;
        $id_professional = 2;
        $services = 1;
        $date = '2024-11-20';
        $get_days_availability = ProfessionalAvailability::getDaysByProfessional($id_professional);
        $get_reservation = ShiftReservation::getRervationByProfessional($id_professional, $date);
        
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $num_days = 7; // Número de días a calcular (puedes cambiarlo a 5 o más)
        $availability_by_day = [];

        // dd($get_days_availability, $get_reservation);   
        // Calcular la disponibilidad para los próximos $num_days días
        for ($i = 0; $i < $num_days; $i++) {
            // $currentDate = date('Y-m-d', strtotime("+$i days", strtotime($date)));
            $currentDate = date('Y-m-d', strtotime($date . " +$i days"));
            $currentDayIndex = date('N', strtotime($currentDate)) - 1; // Índice basado en 0
            $currentDayName = $days[$currentDayIndex];
            // dd($currentDate, $currentDayIndex, $currentDayName);
            // Filtrar disponibilidad por día
            $dayAvailability = array_filter($get_days_availability, function ($day_availability) use ($currentDayName) {
                return $day_availability->day_of_the_week == $currentDayName;
            });
            // if (empty($dayAvailability)) {
            //     continue;
            // }else{
            //     dd($dayAvailability, $dayAvailability[2]->start_time);
            // }

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

                // Reservas para esta fecha
                $reservations = $get_reservation->filter(function ($reservation) use ($currentDate) {
                    return $reservation->date == $currentDate;
                })->pluck('time')->map(function ($time) {
                    return date('H:i', strtotime($time));
                })->toArray();

                // Calcular los turnos disponibles
                $availableSlots = [];   
                while ($startTime < $endTime) {
                    $slot = $startTime->format('H:i');
                    if (!in_array($slot, $reservations)) {
                        $availableSlots[] = $startTime->format('H:i');
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