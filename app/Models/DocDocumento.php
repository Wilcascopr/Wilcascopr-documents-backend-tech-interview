<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocDocumento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tipTipoDoc()
    {
        return $this->hasOne(TipTipoDoc::class, 'id', 'tip_tipo_docs_id');
    }

    public function proProceso()
    {
        return $this->hasOne(ProProceso::class, 'id', 'pro_procesos_id');
    }
}
