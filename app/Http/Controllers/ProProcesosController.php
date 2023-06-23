<?php

namespace App\Http\Controllers;

class ProProcesosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            $procesos = \App\Models\ProProceso::all();
            return response()->json([
                'data' => $procesos,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ], 500);
        }
    }
}
