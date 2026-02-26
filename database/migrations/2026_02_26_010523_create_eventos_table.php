<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('local');
            $table->date('data');
            $table->time('horario');

            $table->enum('recorrencia', [
                'diaria',
                'semanal',
                'mensal',
                'anual'
            ])->default('diaria');

            $table->unsignedBigInteger('id_categoria')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
