<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_ban');
            $table->integer('is_open')->default(1);
            $table->integer('is_open_oder')->default(1);
            $table->unsignedBigInteger('id_tai_khoan');
            $table->foreign('id_tai_khoan')->references('id')->on('tai_khoans');
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
        Schema::table('bans', function (Blueprint $table) {
            $table->dropForeign(['id_tai_khoan']);
        });
        Schema::dropIfExists('bans');
        // $table->dropForeign(['id_tai_khoan']);
        // $table->dropColumn('id_tai_khoan');
    }
}
