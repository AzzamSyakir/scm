<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis',
        'jumlah',
        'harga',
        'harga',
        'status',
        'id gudang'
    ];
}
