<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;
    protected $table = 'bans';

    protected $fillable = [
        'ma_ban',
        'is_open',
        'is_open_oder',
        'id_tai_khoan',
    ];
}
