<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Landing Page Cursos - API",
    description: "API REST desenvolvida em Laravel 11 para gerenciar cursos e competências",
    version: "1.0.0"
)]
#[OA\Server(
    url: "/api",
    description: "Servidor da API"
)]
abstract class Controller
{
    //
}
