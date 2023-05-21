<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $table = 'danh_gias';

    protected $fillable = [
        'san_pham_id',
        'muc_do',
        'id_customer',
    ];
}
