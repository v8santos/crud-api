<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::apiResource('users.address', AddressController::class)->shallow()->parameters([
    'address' => 'addressID'
]);