<?php

namespace App\Http\Controllers;

class TipTipoDocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            $tipoDoc = \App\Models\TipTipoDoc::all();
            return response()->json([
                'data' => $tipoDoc,
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
