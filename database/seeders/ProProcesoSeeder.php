<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $procesos = [
            [
                'nombre' => 'Proceso de Gestión de la Calidad',
                'prefijo' => 'PGC'
            ],
            [
                'nombre' => 'Proceso de Gestión de la Seguridad y Salud en el Trabajo',
                'prefijo' => 'PGSST'
            ],
            [
                'nombre' => 'Proceso de Gestión de la Seguridad de la Información',
                'prefijo' => 'PGSI'
            ],
            [
                'nombre' => 'Proceso de Buenas Prácticas de Manufactura',
                'prefijo' => 'PBPM'
            ],
            [
                'nombre' => 'Proceso de Gestión de Documentos',
                'prefijo' => 'PGD'
            ],
        ];

        foreach ($procesos as $proceso) {
            \App\Models\ProProceso::firstOrCreate($proceso);
        }
    }
}
