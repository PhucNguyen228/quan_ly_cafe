<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tai_khoans')->delete();

        DB::table('tai_khoans')->truncate();

        DB::table('tai_khoans')->insert([
            [
                'ho_va_ten'     => 'Trần Kim Thật',
                'so_dien_thoai' => 917513293,
                'email'         => 'thattran2603@gmail.com',
                'password'      => bcrypt('123456789'),
                'dia_chi'       => 'quế sơn',
                'is_email'      => 1,
                'loai_tai_khoan'=> 1,
                'hash'          => Str::uuid(),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
