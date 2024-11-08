<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Collaborators extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'collaborators';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'created_at',
        'update_at',
    ];

    protected function getAllCollaboratorsByIdBranch($id_branch){
        $all_collaborators = DB::table('collaborators')->where('branch_id', $id_branch)->get();
        return $all_collaborators ? $all_collaborators->toArray() : null;
    }
    protected function saveNewCollaborator($data){
        $collaborator = new Collaborators();
        $collaborator->name = $data['name'];
        $collaborator->surname = $data['surname'];
        $collaborator->email = $data['email'];
        $collaborator->phone = $data['phone'];
        $collaborator->branch_id = $data['branch_id'];
        $collaborator->created_at = $data['created_at'];
        $collaborator->save();
        return $collaborator;
    }
    protected function searchCollaboratorById($id_collaborator){
        $collaborator = Collaborators::find($id_collaborator);
        return $collaborator ? $collaborator : null;
    }
    protected function searchCollaboratorByEmail($email){
        $collaborator = Collaborators::where('email', $email)->first();
        return $collaborator ? $collaborator : null;
    }
}