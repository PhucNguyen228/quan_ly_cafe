<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->string('slug_san_pham');
            $table->integer('gia_ban');
            $table->integer('gia_khuyen_mai');
            $table->string('anh_dai_dien');
            $table->unsignedBigInteger('id_danh_muc');
            $table->integer('is_open')->default(1);
            $table->foreign('id_danh_muc')->references('id')->on('danh_muc_san_phams')->onDelete('cascade');
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
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropForeign(['id_danh_muc']);
            $table->unsignedBigInteger('id_danh_muc')->nullable()->change();
        });
        Schema::dropIfExists('san_phams');
    }
}
