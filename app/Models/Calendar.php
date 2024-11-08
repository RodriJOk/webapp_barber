<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Calendar extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'shift_reservation';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'time',
        'observations',
        'id_user'
    ];

    protected function getAllReservations(){
        $reservations = Calendar::select('id', 'nombre', 'apellido', 'date', 'time', 'observations', 'id_user')->get();
        return $reservations->toArray();
    }

    protected function createShiftReservation($data){
        $shift_reservation = new Calendar();
        $shift_reservation->nombre = $data['nombre'];
        $shift_reservation->apellido = $data['apellido'];
        $shift_reservation->date = $data['fecha_reserva'];  
        $shift_reservation->time = $data['hora_reserva'];
        $shift_reservation->observations = $data['observaciones_reserva'];
        $shift_reservation->id_user = $data['id_usuario'];
        if($shift_reservation->save()){
            return true;
        }else{
            return false;
        }
    }

    protected function serchShiftReservation($data){
        $shift_reservation = Calendar::where('date', $data['fecha_reserva'])
                                             ->where('time', $data['hora_reserva'])
                                             ->where('id_user', $data['id_usuario'])
                                             ->first();
        return $shift_reservation;
    }
}