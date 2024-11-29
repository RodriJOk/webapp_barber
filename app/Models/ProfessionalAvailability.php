<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class ProfessionalAvailability extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'professional_availability';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'professional_id',
        'day_of_the_week',
        'start_time',
        'end_time',
        'created_at',
        'update_at',
        'rest_start_time',
        'rest_end_time',
        'active',
    ];

    protected function getDaysByProfessional($professional_id){
        $days = DB::table('professional_availability')
                    ->where('professional_id', $professional_id)
                    ->select('day_of_the_week', 'start_time', 'end_time')
                    ->get();
        return $days ? $days->toArray() : null;
    }
    protected function getProfessionalAvailability($professional_id){
        $availability = DB::table('professional_availability')
                        ->where('professional_id', $professional_id)
                        ->get();
        return $availability ? $availability->toArray() : null;
    }
    protected function updateProfessionalAvailability($professional_id, $availability){
        foreach ($availability as $day => $availability) {
            $day = ucfirst($day);
            $checked = "";
            if(isset($availability['checked'])){
                if($availability['checked'] == "on"){
                    $checked = 1;
                }else{
                    $checked = 0;
                }
            }else{
                $checked = 0;
            }
            DB::table('professional_availability')
                ->where('professional_id', $professional_id)
                ->where('day_of_the_week', $day)
                ->update([
                    'start_time' => $availability['disponibilidad_inicio'],
                    'end_time' => $availability['disponibilidad_fin'],
                    'rest_start_time' => $availability['descanso_inicio'],
                    'rest_end_time' => $availability['descanso_fin'],
                    'active' => $checked
                ]);
        }

        return true;
    }
    protected function getLastId(){
        $last_id = DB::table('professional_availability')
                    ->orderBy('id', 'desc')
                    ->first();
        return $last_id ? $last_id->id : null;
    }
    protected function saveProfessionalAvailability($data){
        $save = DB::table('professional_availability')
                ->insert($data);
        return $save;
    }
}
