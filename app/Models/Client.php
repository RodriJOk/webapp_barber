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
        'updated_at',
        'id_branch',
        'phone',
        'email',
    ];

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
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected function getClientsByBranchId($id)
    {
        $clients = Client::select('clients.id', 'clients.name', 'clients.surname', 'clients.created_at', 'clients.update_at','clients.email', 'clients.phone', 'branch.name as name_branch', 'branch.id as id_branch')
                         ->join('branch', 'branch.id', '=', 'clients.id_branch', 'inner')
                         ->where('id_branch', $id)->get();
        return $clients ? $clients->toArray() : null;
    }

    protected function searchClient($client_name, $order)
    {
        $clients = Client::select('clients.id', 'clients.name', 'clients.surname', 'clients.created_at', 'clients.update_at','clients.email', 'clients.phone', 'branch.name as name_branch', 'branch.id as id_branch')
                         ->join('branch', 'branch.id', '=', 'clients.id_branch', 'inner');
        if(isset($client_name) && $client_name != null){
            $clients->where('clients.name', 'like', '%'.$client_name.'%');
            $clients->orWhere('clients.surname', 'like', '%'.$client_name.'%');
        }
        if(isset($order) && $order != 0){
            $clients->orderBy('clients.name', $order == 1 ? 'asc' : 'desc');
        }
        $clients = $clients->get();

        return $clients ? $clients->toArray() : null;
    }
}