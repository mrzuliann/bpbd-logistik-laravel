<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_bencana');
            $table->foreign('id_bencana')->references('id')->on('bencana')->onDelete('cascade');
            $table->unsignedBigInteger('id_posko');
            $table->foreign('id_posko')->references('id')->on('posko')->onDelete('cascade');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
            $table->string('qty');
            $table->boolean('status')->nullable()->default(false);
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
        Schema::dropIfExists('pengiriman');
        $table->dropForeign(['id_bencana']);
        $table->dropForeign(['id_posko']);
        $table->dropForeign(['id_barang']);
    }
}
