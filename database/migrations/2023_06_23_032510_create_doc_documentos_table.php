<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doc_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('codigo')->unique(0);
            $table->text('contenido');
            $table->foreignId('tip_tipo_docs_id')->constrained('tip_tipo_docs');
            $table->foreignId('pro_procesos_id')->constrained('pro_procesos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_documentos');
    }
};
