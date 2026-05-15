<?php

return [
    'rajaongkir' => [
        'api_key' => env('RAJAONGKIR_API_KEY'),
        'base_url' => env('RAJAONGKIR_BASE_URL', 'https://api.rajaongkir.com/starter'),
    ],

    'currency_api' => [
        'api_key' => env('CURRENCY_API_KEY'),
        'base_url' => env('CURRENCY_BASE_URL', 'https://api.exchangerate-api.com/v4/latest'),
    ],
];
