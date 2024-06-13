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
        Schema::create('table_point', function (Blueprint $table) {
            $table->id();
            $table->String('name')->nullable();
            $table->String('nomor')->nullable();
            $table->String('jenis')->nullable();
            $table->String('status')->nullable();
            $table->text('description')->nullable();
            $table->geometry('geom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_point');
    }
};
