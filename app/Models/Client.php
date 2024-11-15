<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'created_at',
        'update_at',
        'id_branch',
        'email',
        'phone',
    ];

    public $timestamps = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // protected function casts(): array
    // {
    //     return [
    //         'created_at' => 'datetime',
    //         'update_at' => 'datetime',
    //     ];
    // }

    protected function getClientsByBranchId($id)
    {
        $clients = Client::select('clients.id', 'clients.name', 'clients.surname', 'clients.created_at', 'clients.update_at','clients.email', 'clients.phone', 'branch.name as name_branch', 'branch.id as id_branch')
                         ->join('branch', 'branch.id', '=', 'clients.id_branch', 'inner')
                         ->where('id_branch', $id)->get();
        return $clients ? $clients->toArray() : null;
    }
    protected function createClient($data)
    {
        $client = Client::create([
            'name' => $data['nombre'],
            'surname' => $data['apellido'],
            'email' => $data['email'],
            'phone' => $data['celular'],
            'id_branch' => session('id_branch'),
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        ]);
        return $client ? $client->toArray() : null;
    }
    protected function searchClient($client_name, $order, $id_branch)
    {
        $clients = Client::select('clients.*')
                        ->where('clients.name', 'like', '%'.$client_name.'%')
                        ->orWhere('clients.surname', 'like', '%'.$client_name.'%');
        if($order == 'asc'){
            $clients = $clients->orderBy('clients.name', 'asc');
        }else{
            $clients = $clients->orderBy('clients.name', 'desc');
        }
        $clients = $clients->get();
        return $clients ? $clients->toArray() : null;
    }

}