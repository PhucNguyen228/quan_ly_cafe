<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaiKhoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->id();
            $table->string('ho_va_ten');
            $table->string('so_dien_thoai');
            $table->string('email');
            $table->string('password');
            $table->string('dia_chi')->nullable();
            $table->integer('is_email')->default(0);
            $table->integer('is_open')->default(1);
            $table->integer('loai_tai_khoan');
            $table->string('hash');
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
        Schema::dropIfExists('tai_khoans');
    }
}
