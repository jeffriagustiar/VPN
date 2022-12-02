<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vpn', function (Blueprint $table) {
            $table->id();
            $table->string('nama_vpn');
            $table->string('id_user');
            $table->string('id_paket');
            $table->string('ip')->nullable();
            $table->string('port')->nullable();
            $table->string('bayar')->nullable();
            $table->string('tgl_activ')->nullable();
            $table->string('tgl_inactiv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vpn');
    }
};
