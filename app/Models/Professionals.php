<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Professionals extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'professionals';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'surname',
        'branch_id',
        'created_at',
        'update_at',
        'phone',
        'email',
    ];

    protected function getProfessionalsById($id_branch){
        $all_professionals = DB::table('professionals')->where('branch_id', $id_branch)->get();
        return $all_professionals ? $all_professionals->toArray() : null;
    }
    protected function getAllProfessionalByIdBranch($id_branch){
        $all_collaborators = DB::table('professionals')->where('branch_id', $id_branch)->get();
        return $all_collaborators ? $all_collaborators->toArray() : null;
    }
    protected function saveNewProfessional($data){
        return DB::table('professionals')->insert($data);
    }
    protected function searchProfessionalById($id_professional){
        return DB::table('professionals')->where('id', $id_professional)->first();
    }
    protected function searchProfessionalByEmail($email){
        return DB::table('professionals')->where('email', $email)->first();
    }
    protected function getNewId(){
        $id = DB::table('professionals')->max('id');
        if(!$id){
            return 1;
        }
        return $id + 1;
    }
    protected function getProfessionalById($id){
        $professional = DB::table('professionals')
                          ->join('branch', 'professionals.branch_id', '=', 'branch.id')
                          ->select('professionals.*', 'branch.name as branch_name')
                          ->where('professionals.id', $id)
                          ->first();
        return $professional;
    }
    protected function deleteProfessionalById($id){
        return DB::table('professionals')->where('id', $id)->delete();
    }
    protected function updateProfessionalById($data, $id){
        return DB::table('professionals')->where('id', $id)->update($data);
    }
    protected function alreadyExistProfessionalEmail($email, $id_professional){
        return DB::table('professionals')->where('email', $email)->where('id', '!=', $id_professional)->first();
    }
    protected function alreadyExistPhoneNumber($phone, $id_professional){
        return DB::table('professionals')->where('phone', $phone)->where('id', '!=', $id_professional)->first();
    }
}