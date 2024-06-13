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
        Schema::table('table_point', function (Blueprint $table) {
            $table->string('nomor')->nullable();
        });
        Schema::table('table_polylines', function (Blueprint $table) {
            $table->string('nomor')->nullable();
        });        
        Schema::table('table_polygons', function (Blueprint $table) {
            $table->string('nomor')->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_point', function (Blueprint $table) {
            $table->dropColumn('nomor');
        });
        Schema::table('table_polylines', function (Blueprint $table) {
            $table->dropColumn('nomor');
        });        
        Schema::table('table_polygons', function (Blueprint $table) {
            $table->dropColumn('nomor');
        }); 
    }
};
