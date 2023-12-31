<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguyenLieu extends Model
{
    use HasFactory;
    protected $table = 'nguyen_lieus';

    protected $fillable = [
        'ten_nguyen_lieu',
        'slug_nguyen_lieu',
        'so_luong',
        'don_vi',
        'is_open',
        'id_tai_khoan',

    ];
}
