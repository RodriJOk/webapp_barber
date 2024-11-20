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
        'phone'
    ];

    protected function getProfessionalsById($id_branch){
        $all_professionals = DB::table('professionals')->where('branch_id', $id_branch)->get();
        return $all_professionals ? $all_professionals->toArray() : null;
    }
}