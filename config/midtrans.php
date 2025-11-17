<?php

use phpDocumentor\Reflection\PseudoTypes\True_;

return [
    "is_production" => env('MIDTRANS_IS_PRODUCTION', false),
    "server_key" => env('MIDTRANS_SERVER_KEY'),
    "client_key" => env('MIDTRANS_CLIENT_KEY'),
    "is_sanitized" => env('MIDTRANS_IS_SANITIZED', True),
    "is_3ds" => env('MIDTRANS_IS_3DS', True),
];
