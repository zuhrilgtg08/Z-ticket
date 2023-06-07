<?php

namespace App\Models;
use App\Models\Tiket;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs';
    protected $guarded = ['id'];
    protected $with = ['tiket', 'user', 'hotel', 'pesanan'];
    use HasFactory;

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
