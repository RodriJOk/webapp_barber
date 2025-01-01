<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;
use App\Models\Branch;

class ServicesController extends Controller
{
    public function my_services()
    {
        $id_user = session()->get('id_usuario');
        $myServicesByBranch = Services::getServicesByIdUser($id_user);
        $getAllBranches = Branch::getBranchById($id_user);
        return view('services.index', ['myServicesByBranch' => $myServicesByBranch, 'getAllBranches' => $getAllBranches]);
    }
    public function save_service()
    {
        $validator = Validator::make(request()->all(), [
            'services' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required|numeric',
            'state' => 'required|in:activo,inactivo',
            'branch' => 'required',
        ], [
            'services.required' => 'El nombre del servicio es requerido',
            'description.required' => 'La descripción del servicio es requerida',
            'price.required' => 'El precio del servicio es requerido',
            'duration.required' => 'La duración del servicio es requerida',
            'duration.numeric' => 'La duración del servicio debe ser un número',
            'state.required' => 'El estado del servicio es requerido',
            'state.in' => 'El estado del servicio no es válido',
            'branch.required' => 'La sucursal es requerida',
        ]);
        if ($validator->fails()) {
            toastr()->error('Error al guardar el servicio' . $validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = [
            'services' => request()->services,
            'description' => request()->description,
            'price' => request()->price,
            'duration' => request()->duration,
            'state' => request()->state,
            'branch' => request()->branch,
        ];
        if(!Services::saveService($data)){
            toastr()->error('Error al guardar el servicio');
            return redirect()->route('my_services');
        }

        toastr()->success('Servicio guardado correctamente');
        return redirect()->route('my_services');
    }
}