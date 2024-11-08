<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class CollaboratorsAvailability extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'collaborators_availability';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'collaborator_id',
        'day_of_the_week',
        'start_time',
        'end_time',
        'start_rest_time',
        'end_rest_time',
        'created_at',
        'update_at',
    ];

    protected function setCollaboratorAvailability($data){
        $collaborator_availability = new CollaboratorsAvailability();
        $collaborator_availability->collaborator_id = $data['collaborator_id'];
        $collaborator_availability->day_of_the_week = $data['day_of_the_week'];
        $collaborator_availability->start_time = $data['start_time'];
        $collaborator_availability->end_time = $data['end_time'];
        $collaborator_availability->start_rest_time = $data['start_rest_time'];
        $collaborator_availability->end_rest_time = $data['end_rest_time'];
        $collaborator_availability->created_at = $data['created_at'];
        
        $collaborator_availability->save();
        return $collaborator_availability;
    }

    protected function getCollaboratorAvailability($collaborator_id){
        $collaborator_availability = DB::table('collaborators_availability')
            ->where('collaborator_id', $collaborator_id)
            ->get();
        return $collaborator_availability;
    }
}