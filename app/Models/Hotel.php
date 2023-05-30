<?php

namespace App\Models;
use App\Models\Tiket;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    protected $guarded = ['id'];
    protected $table = 'hotel';
    protected $with = ['review'];
    use HasFactory, Sluggable;

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['cari_hotel'] ?? false, function ($query, $cari_hotel) {
            return $query->where('nama_hotel', 'like', '%' . $cari_hotel . '%')
                ->orWhere('kode_hotel', 'like', '%' . $cari_hotel . '%');
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
