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
    ];

    protected function getServicesByBranch($branch_id){
        $services = DB::table('services')
            ->where('branch_id', $branch_id)
            ->get();
        return $services;
    }
}