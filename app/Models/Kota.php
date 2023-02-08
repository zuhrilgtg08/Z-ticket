<?php

namespace App\Models;
use App\Models\Tiket;
use App\Models\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kota';
    protected $guarded = ['id'];

    public function provinsi()
    {
        return $this->BelongsTo(Provinsi::class, 'provinsi_id');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}
