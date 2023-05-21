<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhMucSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc_san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_danh_muc');
            $table->string('slug_danh_muc');
            $table->integer('is_delete')->default(0);
            $table->integer('is_open');
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
        Schema::table('danh_muc_san_phams', function (Blueprint $table) {
            $table->dropForeign(['id_tai_khoan']);
        });
        Schema::dropIfExists('danh_muc_san_phams');
    }
}
