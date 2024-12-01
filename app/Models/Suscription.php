<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Suscription extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'suscription';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'type',
        'start_date',
        'end_date',
        'activo',
        'id_pago',
        'id_cliente'
    ];

    protected function getSuscriptionByUser($id_user) {
        $susc = DB::table('suscription')
            ->where('id_cliente', $id_user)
            ->get();
        return $susc;
    }
    protected function getLastSuscriptionByUser($id_user) {
        $susc = DB::table('suscription')
            ->where('id_cliente', $id_user)
            ->orderBy('id', 'desc')
            ->first();
        return $susc;
    }
}