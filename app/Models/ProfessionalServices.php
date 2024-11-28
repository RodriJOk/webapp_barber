<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class ProfessionalServices extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'professional_services';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_professional',
        'id_services',
    ];

    protected function getServicesByProfessional($id_professional){
        $services = DB::table('professional_services')
                      ->join('services', 'professional_services.id_services', '=', 'services.id')
                      ->where('professional_services.id_professional', $id_professional)
                      ->select('services.id', 
                               'services.name', 
                               'services.description', 
                               'services.price', 
                               'services.duration',
                               'professional_services.id')
                      ->get();
        return $services ? $services->toArray() : null;
    }
}