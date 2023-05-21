<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class TaiKhoan extends Authenticatable
{
    use HasFactory;
    protected $table = 'tai_khoans';

    protected $fillable = [
       'ho_va_ten',
       'so_dien_thoai',
       'email',
       'password',
       'dia_chi',
       'is_email',
       'is_open',
       'loai_tai_khoan',
       'hash',
    ];
}
