<?php
namespace App\Services;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

// MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

class MercadoPagoServices
{
    public function createPreference()
    {
        // Configurar credenciales
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
    }
    public function success()
    {
        return 'Pago exitoso';
    }
    public function failure()
    {
        return 'El pago ha fallado';
    }
    public function pending()
    {
        return 'Pago pendiente';
    }
}