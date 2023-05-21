<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietHoaDonOlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_hoa_don_olines', function (Blueprint $table) {
            $table->id();
            $table->integer('san_pham_id');
            $table->string('ten_san_pham');
            $table->integer('so_luong')->default(1);
            $table->double('don_gia', 18, 0);
            $table->string('ho_va_ten')->nullable();
            $table->integer('so_dien_thoai')->nullable();
            $table->string('dia_chi')->nullable();
            $table->integer('is_cart')->default(1);
            $table->integer('hoa_don_id')->nullable();
            $table->integer('agent_id');
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
        Schema::dropIfExists('chi_tiet_hoa_don_olines');
    }
}
