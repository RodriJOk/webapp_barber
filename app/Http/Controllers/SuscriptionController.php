<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Suscription;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
// use MercadoPago\RequestOptions\RequestOptions;
use MercadoPago\RequestOptions\Payment\PaymentCreateRequestOptions;
use MercadoPago\Client\Common\RequestOptions;

class SuscriptionController extends Controller
{
    public function suscription(){
        return view('suscription/index', ['suscriptions' => $suscriptions]);
    }
    public function index(){
        MercadoPagoConfig::setAccessToken('APP_USR-4245916803958684-100314-c8773e08b4ca9d58a840006b8bcbfef8-218698516');
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        
        $client = new PreferenceClient();
        try {
            $request_options = new RequestOptions();
            
            $preference = $client->create([
                'external_reference' => '1234',
                'items' => [
                    [
                        'id' => '1234',
                        'title' => 'Test',
                        'quantity' => 1,
                        'currency_id' => 'ARS',
                        'unit_price' => 10.0
                    ]
                ],
            ], $request_options);
        } catch (\Exception $e) {
            \Log::error('Error al crear preferencia: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo crear la preferencia. Intenta nuevamente.'], 500);
        }            
        $preferenceId = $preference->id;

        $id_usuario = session('id_usuario');

        $suscriptions = Suscription::getSuscriptionByUser($id_usuario);

        $last_suscription = Suscription::getLastSuscriptionByUser($id_usuario);
        $date_now = date('Y-m-d');
        $suscription_status = 'active';
    
        $suscription_message = [
            'active' => 'Tienes una suscripción activa',
            'inactive' => 'No tienes una suscripción activa',
            'interrupted' => 'Tu suscripción ha sido interrumpida'
        ];

        if($last_suscription){
            if($date_now > date('Y-m-d', strtotime($last_suscription->end_date))){
                $suscription_status = 'interrupted';
            }
        }else{
            $suscription_status = 'inactive';
        }

        return view('suscription/index', [
            'suscriptions' => $suscriptions, 
            'preference' => $preference, 
            'preferenceId' => $preferenceId,
            'last_suscription' => $last_suscription,
            'suscription_status' => $suscription_status,
            'suscription_message' => $suscription_message[$suscription_status]
        ]);
    }
}