<?php

namespace Database\Factories;

use App\Models\ProProceso;
use App\Models\TipTipoDoc;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocDocumento>
 */
class DocDocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipTipoDoc = TipTipoDoc::factory()->create();
        $proProceso = ProProceso::factory()->create();
        return [
            'nombre' => 'example',
            'contenido' => 'ipsun lorem',
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' => $proProceso->id,
            'codigo' => $tipTipoDoc->prefijo . '-' . $proProceso->prefijo . '-0001',
        ];
    }
}
