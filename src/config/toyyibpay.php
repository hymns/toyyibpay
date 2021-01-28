<?php

return [
  'client_secret' => env('TOYYIBPAY_USER_SECRET_KEY', ''),
  'redirect_uri' => env('TOYYIBPAY_REDIRECT_URI', ''),
  'production_mode' => env('TOYYIBPAY_PRODUCTION_MODE', false),
];
