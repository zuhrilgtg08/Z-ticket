<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Review;
use App\Models\Keranjang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tiket';
    protected $with = ['kota', 'provinsi', 'category', 'keranjang', 'hotel'];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'tiket_id');
    }

    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['cari'] ?? false, function ($query, $cari) {
            return $query->where('nama_tiket', 'like', '%' . $cari . '%')
                ->orWhere('kode_tiket', 'like', '%' . $cari . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['kota'] ?? false, function ($query, $kota) {
            return $query->whereHas('kota', function ($query) use ($kota) {
                $query->where('nama_kota', $kota);
            });
        });

        $query->when($filters['provinsi'] ?? false, function ($query, $provinsi) {
            return $query->whereHas('provinsi', function ($query) use ($provinsi) {
                $query->where('nama_provinsi', $provinsi);
            });
        });
    }
}
