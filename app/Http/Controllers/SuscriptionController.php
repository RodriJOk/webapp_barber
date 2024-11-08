<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Suscription;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class SuscriptionController extends Controller
{
    public function index(){
        MercadoPagoConfig::setAccessToken('APP_USR-4245916803958684-100314-c8773e08b4ca9d58a840006b8bcbfef8-218698516');
        $client = new PreferenceClient();

        // Crear preferencia
        $preference = $client->create([
            'items' => [
                [
                    'id' => '1234',
                    'title' => 'Test',
                    'quantity' => 1,
                    'currency_id' => 'ARS',
                    'unit_price' => 10.0
                ]
            ],
            'statement_descriptor' => 'Test',
            'external_reference' => '1234',
        ]); 
        
        //Buscar el id del usuario logueado
        $id_usuario = session('id_usuario');
        //Buscar por el id del cliente

        $get_suscription = Suscription::getSuscriptionByUser($id_usuario);

        return view('suscription/index', ['preference' => $preference, 'suscriptions' => $get_suscription]);
    }
}