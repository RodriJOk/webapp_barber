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
        'nombre',
        'apellido',
        'date',
        'time',
        'observations',
        'id_user',
        'created_at',
        'updated_at',
        'id_professional',
        'id_services',
        'id_branch',
    ];

    protected function getAllReservations(){
        $reservations = Calendar::select('id', 'nombre', 'apellido', 'date', 'time', 'observations', 'id_user')->get();
        return $reservations->toArray();
    }

    protected function createShiftReservation($data){

        $shift_reservation = new Calendar();
        $shift_reservation->nombre = $data['nombre'];
        $shift_reservation->apellido = $data['apellido'];
        $shift_reservation->date = $data['date'];  
        $shift_reservation->time = $data['time'];
        $shift_reservation->observations = $data['observations'];
        $shift_reservation->id_user = $data['id_user'];
        $shift_reservation->created_at = $data['created_at'];
        $shift_reservation->updated_at = $data['updated_at'];
        $shift_reservation->id_professional = $data['id_professional'];
        $shift_reservation->id_services = $data['id_service'];
        $shift_reservation->id_branch = $data['id_branch'];

        return $shift_reservation->save();
    }

    protected function serchShiftReservation($data){
        $shift_reservation = Calendar::where('date', $data['fecha_reserva'])
                                             ->where('time', $data['hora_reserva'])
                                             ->where('id_user', $data['id_usuario'])
                                             ->first();
        return $shift_reservation;
    }
}