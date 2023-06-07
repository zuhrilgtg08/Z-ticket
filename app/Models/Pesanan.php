<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid as Traits;
use App\Models\Keranjang;

class Pesanan extends Model
{
    use HasFactory, Traits;
    
    protected $fillable = [
        'total_pembayaran',
        'payment_status',
        'snap_token'
    ];

    protected $table = 'pesanans';

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}
