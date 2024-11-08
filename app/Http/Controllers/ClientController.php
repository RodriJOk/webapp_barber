<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

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
}