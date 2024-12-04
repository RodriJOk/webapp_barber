<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', compact('branches'));
    }
    public function update_profile(Request $request)
    {
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
}