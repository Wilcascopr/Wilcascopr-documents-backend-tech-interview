<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocDocumentoController extends Controller
{
    private $Documento;
    private $TipoDocumento;
    private $Proceso;
    public function __construct(\App\Models\DocDocumento $Documento, \App\Models\TipTipoDoc $TipoDocumento, \App\Models\ProProceso $Proceso)
    {
        $this->middleware('auth:sanctum');
        $this->Documento = $Documento;
        $this->TipoDocumento = $TipoDocumento;
        $this->Proceso = $Proceso;
    }
    public function index(Request $request)
    {

        $validator = validator($request->all(), [
            'search' => 'string|nullable',
            'tip_tipo_docs_id' => 'numeric|nullable|exists:tip_tipo_docs,id',
            'pro_procesos_id' => 'numeric|nullable|exists:pro_procesos,id',
        ]);

        if ($validator->fails()) 
            return response()->json([
                'message' => 'Hubo un error de validación. ' . $validator->errors()->first(),
            ], 422);

        try {

            $documentos = $this->Documento->with(['tipTipoDoc', 'proProceso']);

            if ($request->has('search'))
                $documentos = $documentos->where('nombre', 'like', '%' . $request->search . '%');
            
            if ($request->has('tip_tipo_docs'))
                $documentos = $documentos->where('tip_tipo_docs_id', $request->tip_tipo_docs);
            
            if ($request->has('pro_procesos'))
                $documentos = $documentos->where('pro_procesos_id', $request->pro_procesos);
            
            $documentos = $documentos->get();

            return response()->json([
                'data' => $documentos,
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ], 500);
        }
        
    }

    public function show($id)
    {   
        $validator = validator(['id' => $id], [
            'id' => 'required|numeric|exists:doc_documentos,id',
        ]);

        if ($validator->fails()) 
            return response()->json([
                'message' => 'Hubo un error de validación. ' . $validator->errors()->first(),
            ], 422);

        try {
            $documento = $this->Documento->with(['tipTipoDoc', 'proProceso'])->findOrFail($id);

            return response()->json([
                'data' => $documento,
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'nombre' => 'required|string',
            'contenido' => 'required|string',
            'tip_tipo_docs_id' => 'required|numeric|exists:tip_tipo_docs,id',
            'pro_procesos_id' => 'required|numeric|exists:pro_procesos,id',
        ]);

        if ($validator->fails()) 
            return response()->json([
                'message' => 'Hubo un error de validación. ' . $validator->errors()->first(),
            ], 422);
        
        try {

            $tip_tipo_doc = $this->TipoDocumento->find($request->tip_tipo_docs_id);
            $pro_proceso = $this->Proceso->find($request->pro_procesos_id);

            $codigo = $tip_tipo_doc->prefijo . '-' . $pro_proceso->prefijo;

            $documento = $this->Documento->create([
                'nombre' => $request->nombre,
                'contenido' => $request->contenido,
                'tip_tipo_docs_id' => $request->tip_tipo_docs_id,
                'pro_procesos_id' => $request->pro_procesos_id,
                'codigo' => ''
            ]);

            $documento->codigo = $codigo . '-' . $documento->id;
            $documento->save();

            return response()->json([
                'data' => $documento,
                'message' => 'El documento se creó correctamente.'
            ], 201);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Hubo un error al crear el documento. ' . $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = validator($request->all() + ['id' => $id], [
            'id' => 'required|numeric|exists:doc_documentos,id',
            'nombre' => 'required|string',
            'contenido' => 'required|string',
            'tip_tipo_docs_id' => 'required|numeric|exists:tip_tipo_docs,id',
            'pro_procesos_id' => 'required|numeric|exists:pro_procesos,id',
        ]);

        if ($validator->fails()) 
            return response()->json([
                'message' => 'Hubo un error de validación. ' . $validator->errors()->first(),
            ], 422);
        
        try {

            $documento = $this->Documento->find($id);

            if ($documento->tip_tipo_docs_id !== $request->tip_tipo_docs_id || $documento->pro_procesos_id !== $request->pro_procesos_id)
            {
                $tip_tipo_doc = $this->TipoDocumento->find($request->tip_tipo_docs_id);
                $pro_proceso = $this->Proceso->find($request->pro_procesos_id);
                $codigo = $tip_tipo_doc->prefijo . '-' . $pro_proceso->prefijo . '-' . $documento->id;
            }
            
            $documento->update([
                'nombre' => $request->nombre,
                'contenido' => $request->contenido,
                'tip_tipo_docs_id' => $request->tip_tipo_docs_id,
                'pro_procesos_id' => $request->pro_procesos_id,
                'codigo' => $codigo ?? $documento->codigo,
            ]);

            return response()->json([
                'data' => $documento,
                'message' => 'El documento se actualizó correctamente.'
            ], 201);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Hubo un error al actualizar el documento. ' . $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $validator = validator(['id' => $id], [
            'id' => 'required|numeric|exists:doc_documentos,id',
        ]);

        if ($validator->fails()) 
            return response()->json([
                'message' => 'Hubo un error de validación. ' . $validator->errors()->first(),
            ], 422);

        try {
            $this->Documento->where('id', $id)->delete();

            return response()->json([], 201);

        } catch (\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ], 500);
        }
    }
}
