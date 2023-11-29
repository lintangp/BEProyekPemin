<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('budget_datas', function (Blueprint $table) {
            $table->increments('id_data_anggaran');
            $table->unsignedInteger('id_kelompok_anggaran');
            $table->integer('anggaran');
            $table->date('tanggal');
            $table->enum('jenis', ['keluar', 'masuk']);
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_kelompok_anggaran')
                  ->references('id')
                  ->on('budget_groups')
                  ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_datas');
    }
};
