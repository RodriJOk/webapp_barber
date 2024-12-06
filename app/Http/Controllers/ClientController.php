<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(Request $request){
        $id_usuario = session('id_usuario');
        $id_branch = session('id_branch');
        $clients = Client::getClientsByBranchId($id_branch);
        foreach ($clients as $key => $client) {
            $clients[$key]['created_at'] = date('d-m-Y', strtotime($client['created_at']));
        }

        $search_name = null;
        $search_order = null;
        $search_result = null;
        if(isset($request->search) && $request->search != null){
            $client_name = $request->search;
            $order = $request->order;
            $search_result = Client::searchClient($client_name, $order);
            foreach ($search_result as $key => $client) {
                $search_result[$key]['created_at'] = date('d-m-Y', strtotime($client['created_at']));
            }
            $search_name = $client_name;
            $search_order = $order;
        }

        return view('client/index', compact('clients', 'id_usuario', 'id_branch', 'search_result', 'search_name', 'search_order'));
    }
    public function create_client(){
        $data = request()->all();
        
        $nombre = $data['nombre'];
        $apellido = $data['surname'];
        $email = $data['email'];
        $telefono = $data['celular_telefono'];

        $rules = [
            'nombre' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'celular_telefono' => 'required'
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
            'surname.required' => 'El campo apellido es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email',
            'celular_telefono.required' => 'El campo celular es requerido'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            toastr()->error('Error en los datos ingresados' . $validator->errors());
            return redirect('/my_clients')
                ->withErrors($validator)
                ->withInput();
        }

        $client_information = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'id_branch' => session('id_branch'),
            'celular' => $telefono,
            'email' => $email
        ];

        $client = Client::createClient($client_information);
        if(!$client){
            toastr()->error('Error al crear el cliente. Intente nuevamente más tarde');
            return redirect('/my_clients');
        }

        toastr()->success('Cliente creado correctamente');
        return redirect('/my_clients');


    }
    public function search_client(){
        $search_name = strtolower(request()->input('name_search'));
        $search_order = request()->input('order');

        if($search_order != 'asc' && $search_order != 'desc'){
            $search_order = null;
        }
        $id_branch = session('id_branch');
        $search_result = Client::searchClient($search_name, $search_order, $id_branch);
        $id_usuario = session('id_usuario');
        return view('client/index', compact('id_usuario', 'id_branch', 'search_result', 'search_name', 'search_order'));
    }
}