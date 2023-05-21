<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDonOline extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_hoa_don_olines';

    protected $fillable = [
        'san_pham_id',
        'ten_san_pham',
        'so_luong',
        'don_gia',
        'ho_va_ten',
        'so_dien_thoai',
        'dia_chi',
        'is_cart',
        'hoa_don_id',
        'agent_id',
    ];
}
