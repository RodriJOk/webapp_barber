<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index()
    {
        $id_user = session('id_usuario');
        $branches = Branch::getBranchById($id_user);
        return view('branch.index', compact('branches'));
    }
    public function new_branch()
    {
        return view('branch.new_branch');
    }
    public function create_branch(){
        $data = request()->all();
        
        $rules = [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|min:8|max:10|regex:/^[0-9]+$/'
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'name.max' => 'El campo nombre debe tener como máximo 255 caracteres',
            'name.regex' => 'El campo nombre debe contener solo letras',
            'address.required' => 'El campo dirección es requerido',
            'address.min' => 'El campo dirección debe tener al menos 3 caracteres',
            'address.max' => 'El campo dirección debe tener como máximo 255 caracteres',
            'phone.required' => 'El campo teléfono es requerido',
            'phone.min' => 'El campo teléfono debe tener al menos 8 caracteres',
            'phone.max' => 'El campo teléfono debe tener como máximo 10 caracteres',
            'phone.regex' => 'El campo teléfono debe contener solo números',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados' . $validator->errors());
            return redirect()->route('new_branch')->withErrors($validator)->withInput();
        }

        $info_branch = [
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'id_user' => session('id_usuario'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if(!Branch::createBranch($info_branch)){
            toastr()->error('Error al crear la sucursal');
            return redirect()->route('new_branch');
        }

        toastr()->success('Sucursal creada correctamente');
        return redirect()->route('my_branch');

    }
    public function update_profile(Request $request){
        $id_branch = $request->id;
        $branch = Branch::find($id_branch);
        $branch->name = $request->nombre;
        $branch->address = $request->direccion;
        $branch->phone = $request->celular_telefono;
        $branch->update_at = date('Y-m-d H:i:s');
        $branch->save();
        toastr()->success('Datos de la sucursal actualizados correctamente');
        return redirect()->route('my_profile');
    }
    public function delete_branch($branch_id){
        dd($branch_id);
        $id_branch = $branch_id;
        $branch = Branch::find($id_branch);
        $branch->delete();
        toastr()->success('Sucursal eliminada correctamente');
        return redirect()->route('my_branch');
    }
}