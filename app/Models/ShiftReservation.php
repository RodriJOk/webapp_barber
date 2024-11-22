<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class ShiftReservation extends Authenticatable{
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
        'id_service',
        'id_branch',
    ];

    protected function getRervationByProfessional($id_professional, $date){
        $reservations = DB::table('shift_reservation')
            ->where('id_professional', $id_professional)
            ->where('date', '>=', $date)
            ->get();
        return $reservations;
    }
}