<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\DocDocumento;
use App\Models\ProProceso;
use App\Models\TipTipoDoc;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function testIndexWithValidInputs()
    {   
        $user = \App\Models\User::factory()->create();
        $tipTipoDoc = TipTipoDoc::factory()->create();
        $proProceso = ProProceso::factory()->create();
        $response = $this->actingAs($user)->json('GET', '/api/doc-documentos', [
            'search' => 'example',
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' => $proProceso->id,
        ]);

        \Log::info($response->getContent());
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    public function testIndexWithMissingSearchParameter()
    {   
        $user = \App\Models\User::factory()->create();
        $tipTipoDoc = TipTipoDoc::factory()->create();
        $proProceso = ProProceso::factory()->create();
        $response = $this->actingAs($user)->json('GET', '/api/doc-documentos', [
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' =>  $proProceso->id,
        ]);

        \Log::info($response->getContent());
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    public function testIndexWithInvalidTipTipoDocsId()
    {
        $user = \App\Models\User::factory()->create();
        $proProceso = ProProceso::factory()->create();
        $response = $this->actingAs($user)->json('GET', '/api/doc-documentos', [
            'search' => 'example',
            'tip_tipo_docs_id' => 999, // Invalid ID
            'pro_procesos_id' => $proProceso->id,
        ]);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The selected tip tipo docs id is invalid.',
            ]);
    }

    public function testIndexWithInvalidProProcesosId()
    {
        
        $user = \App\Models\User::factory()->create();
        $tipTipoDoc = TipTipoDoc::factory()->create();
        $response = $this->actingAs($user)->json('GET', '/api/doc-documentos', [
            'search' => 'example',
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' => 999, // Invalid ID
        ]);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The selected pro procesos id is invalid.',
            ]);
    }

    public function testShowWithValidId()
    {
        $user = \App\Models\User::factory()->create();

        $documento = DocDocumento::factory()->create();

        $response = $this->actingAs($user)->json('GET', '/api/doc-documentos/' . $documento->id);

        \Log::info($response->getContent());
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    public function testShowWithInvalidId()
    {
        
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->json('GET', '/api/doc-documentos/999');

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The selected id is invalid.',
            ]);
    }

    public function testStoreWithValidData()
    {
        $user = \App\Models\User::factory()->create();

        $tipTipoDoc = TipTipoDoc::factory()->create();
        $proProceso = ProProceso::factory()->create();

        $data = [
            'nombre' => 'Document Name',
            'contenido' => 'Document Content',
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' => $proProceso->id,
        ];

        $response = $this->actingAs($user)->json('POST', '/api/doc-documentos', $data);

        \Log::info($response->getContent());
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'El documento se creó correctamente.',
            ]);
    }

    public function testStoreWithMissingData()
    {
        
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->json('POST', '/api/doc-documentos', []);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The nombre field is required.',
            ]);
    }

    public function testStoreWithInvalidTipTipoDocsId()
    {
        $user = \App\Models\User::factory()->create();

        $proProceso = ProProceso::factory()->create();

        $data = [
            'nombre' => 'Document Name',
            'contenido' => 'Document Content',
            'tip_tipo_docs_id' => 999, // Invalid ID
            'pro_procesos_id' => $proProceso->id,
        ];

        $response = $this->actingAs($user)->json('POST', '/api/doc-documentos', $data);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The selected tip tipo docs id is invalid.',
            ]);
    }

    public function testStoreWithInvalidProProcesosId()
    {
        $user = \App\Models\User::factory()->create();
        $tipTipoDoc = TipTipoDoc::factory()->create();

        $data = [
            'nombre' => 'Document Name',
            'contenido' => 'Document Content',
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' => 999, // Invalid ID
        ];

        $response = $this->actingAs($user)->json('POST', '/api/doc-documentos', $data);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The selected pro procesos id is invalid.',
            ]);
    }

    public function testUpdateWithValidIdAndData()
    {
        
        $user = \App\Models\User::factory()->create();

        $documento = DocDocumento::factory()->create();
        $tipTipoDoc = TipTipoDoc::factory()->create();
        $proProceso = ProProceso::factory()->create();

        $data = [
            'nombre' => 'Updated Document Name',
            'contenido' => 'Updated Document Content',
            'tip_tipo_docs_id' => $tipTipoDoc->id,
            'pro_procesos_id' => $proProceso->id,
        ];

        $response = $this->actingAs($user)->json('PUT', '/api/doc-documentos/' . $documento->id, $data);

        \Log::info($response->getContent());
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'El documento se actualizó correctamente.',
            ]);
    }

    public function testUpdateWithValidIdAndMissingData()
    {
        $user = \App\Models\User::factory()->create();

        $documento = DocDocumento::factory()->create();

        $response = $this->actingAs($user)->json('PUT', '/api/doc-documentos/' . $documento->id, []);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The nombre field is required.',
            ]);
    }

    public function testUpdateWithInvalidId()
    {
        $user = \App\Models\User::factory()->create();

        $data = [
            'nombre' => 'Updated Document Name',
            'contenido' => 'Updated Document Content',
            'tip_tipo_docs_id' => 1,
            'pro_procesos_id' => 1,
        ];

        $response = $this->actingAs($user)->json('PUT', '/api/doc-documentos/999', $data);

        \Log::info($response->getContent());
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Hubo un error de validación. The selected id is invalid.',
            ]);
    }
}
