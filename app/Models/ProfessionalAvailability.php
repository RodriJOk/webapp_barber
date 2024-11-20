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
        'update_at'
    ];

    protected function getDaysByProfessional($professional_id){
        $days = DB::table('professional_availability')
                    ->where('professional_id', $professional_id)
                    ->select('day_of_the_week', 'start_time', 'end_time')
                    ->get();
        return $days ? $days->toArray() : null;
    }
}