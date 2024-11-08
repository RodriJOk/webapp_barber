<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function index(){
        $get_all_reservations = Calendar::getAllReservations();
        return view('calendar/index', ['reservations' => $get_all_reservations]);
    }
    public function create_event()
    {
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
}