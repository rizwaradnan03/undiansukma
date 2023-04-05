<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setups', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nama');

            $table->unsignedBigInteger('periode_id')->default('1');
            $table->foreign('periode_id')->references('id')->on('sistems')->onDelete('cascade');

            $table->enum('status',['0','1'])->default('0');
            $table->integer('jumlah');
            $table->string('jumlah_display');
            $table->timestamps();
        });
        // DB::table('setups')->insert(
        //     array(
        //         ['nama' => 'LED TV (1)'],
        //         ['nama' => 'LED TV (2)'],
        //         ['nama' => 'SEPEDA MTB (1)'],
        //         ['nama' => 'SEPEDA MTB (2)'],
        //         ['nama' => 'BLENDER (1)'],
        //         ['nama' => 'BLENDER (2)'],
        //         ['nama' => 'TABUNGAN (1)'],
        //         ['nama' => 'TABUNGAN (2)'],
        //         ['nama' => 'MESIN CUCI (1)'],
        //         ['nama' => 'MESIN CUCI (2)'],
        //         ['nama' => 'LEMARI ES (1)'],
        //         ['nama' => 'LEMARI ES (2)'],
        //         ['nama' => 'TABLET PHONE (1)'],
        //         ['nama' => 'TABLET PHONE (2)'],
        //         ['nama' => 'KOMPOR (1)'],
        //         ['nama' => 'KOMPOR (2)'],
        //     )
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setups');
    }
};
