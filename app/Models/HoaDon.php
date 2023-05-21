<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoa_dons';

    protected $fillable = [
        'ma_hoa_don',
        'tong_tien',
        'tien_giam_gia',
        'thuc_tra',
        'id_ban',
        'agent_id',
        'loai_thanh_toan',
        'tinh_trang_don_hang',
        'loai_hoa_don',
        'ngay_hoa_don',
        'shipper_id',
        'hoan_thanh'
    ];

    // public function chi_tiet_hoa_don_olines()
    // {
    //     return $this->hasMany(ChiTietHoaDonOline::class, 'hoa_don_id', 'id');
    // }
}
