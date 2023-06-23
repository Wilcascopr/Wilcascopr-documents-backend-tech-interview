<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipTipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposDocumento = [
            [
                'nombre' => 'Documento Identidad',
                'prefijo' => 'DI'
            ],
            [
                'nombre' => 'Documento Contratación',
                'prefijo' => 'DC'
            ],
            [
                'nombre' => 'Documento Certificación de Producto',
                'prefijo' => 'DCP'
            ],
            [
                'nombre' => 'Documento de Desarrollo',
                'prefijo' => 'DD'
            ],
            [
                'nombre' => 'Documento de Gestión',
                'prefijo' => 'DG'
            ],
        ];

        foreach ($tiposDocumento as $tipoDocumento) {
            \App\Models\TipTipoDoc::firstOrCreate($tipoDocumento);
        }
    }
}
