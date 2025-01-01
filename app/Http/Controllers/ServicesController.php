<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;

class ServicesController extends Controller
{
    public function my_services()
    {
        $id_user = session()->get('id_usuario');
        $myServicesByBranch = Services::getServicesByIdUser($id_user);
        return view('services.index', ['myServicesByBranch' => $myServicesByBranch]);
    }
    public function save_service()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required|numeric',
            'state' => 'required|in:activo,inactivo'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = [
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
            'duration' => request()->duration,
            'state' => request()->state
        ];

        if(!Services::saveService($data)){
            toast()->error('Error al guardar el servicio');
            return redirect()->route('my_services');
        }

        toast()->success('Servicio guardado correctamente');
        return redirect()->route('my_services');
    }
}