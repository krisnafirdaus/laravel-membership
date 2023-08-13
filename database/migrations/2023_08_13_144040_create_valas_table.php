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
        Schema::create('valas', function (Blueprint $table) {
            $table->id();
            $table->string('NamaValas');
            $table->decimal('Nilai_Jual', 18, 2);
            $table->decimal('Nilai_Beli', 18, 2);
            $table->date('Tanggal_Rate');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valas');
    }
};
