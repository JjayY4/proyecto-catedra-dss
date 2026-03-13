<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', function (Request $request) {
return response()->json([
        'estado' => 'exito',
        'mensaje' => 'ruta funcionando correctamente',
        'data' => $request->all()
    ]);
});