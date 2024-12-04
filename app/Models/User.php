<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected function role()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
    protected function getUserById($id)
    {
        $user = User::select('*')->where('id', $id)->first();
        return $user ? $user->toArray() : null;
    }

    protected function getUsers()
    {
        $usuarios = User::select('id', 'name', 'email')->get();
        return $usuarios->toArray();
    }

    protected function exitUser($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    protected function getUserByEmail($email){
        $user = User::select('users.*', 'roles.name as rol')->join('roles', 'users.rol_id', '=', 'roles.id')->where('users.email', $email)->first();
        return $user;
    }

    protected function saveNewPassword($email, $password)
    {   
        $user = User::where('email', $email)->first();
        $user->password = $password;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        return $user;
    }
    protected function getBranchByUserId($id_user){
        $branch = User::select('*')->join('branch', 'branch.id_user', '=', 'users.id')->where('users.id', $id_user)->first();
        return $branch ? $branch->toArray() : null;
    }
    protected function saveUser($data){
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->email_verified_at = $data['email_verified_at'];
        $user->password = $data['password'];
        $user->remember_token = $data['remember_token'];
        $user->created_at = $data['created_at'];
        $user->rol_id = $data['rol'];
        $user->save();
        return $user;
    }
}