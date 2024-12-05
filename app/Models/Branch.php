<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Branch extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'branch';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'id_user',
        'phone',
        'created_at',
        'update_at'
    ];

    protected function getBranchByUserId($id_user){
        $branch = Branch::select('*')->where('id_user', $id_user)->first();
        return $branch ? $branch->toArray() : null;
    }
    protected function getBranchById($id){
        $branch = Branch::select('*')->where('id_user', $id)->get();
        return $branch ? $branch->toArray() : null;
    }
}