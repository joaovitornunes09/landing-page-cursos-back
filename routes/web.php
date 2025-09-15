<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'API Landing Page Cursos - O POVO',
        'version' => '1.0.0',
        'docs' => '/api/courses'
    ]);
});
