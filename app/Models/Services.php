<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Services extends Authenticatable{
    use HasFactory, Notifiable;
    protected $table = 'services';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'branch_id',
        'created_at',
        'updated_at',
        'price',
        'duration',
        'estado'
    ];

    protected function getServicesByIdUser($id_user)
    {
        $services = DB::table('branch')
                    ->join('services', 'branch.id', '=', 'services.branch_id')
                    ->where('branch.id_user', $id_user)
                    ->select('services.*', 'branch.id as branch_id', 'branch.name as branch_name')
                    ->get();
        return $services;
    }

    protected function saveService($data){
        $service = new Services();
        $service->name = $data['services'];
        $service->description = $data['description'];
        $service->branch_id = $data['branch'];
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->price = $data['price'];
        $service->duration = $data['duration'];
        $service->state = $data['state'];
        $service->save();
        return true;
    }
    protected function deleteService($id_service){
        $service = Services::find($id_service);
        $service->state = 'inactivo';
        $service->save();
        return true;
    }
}