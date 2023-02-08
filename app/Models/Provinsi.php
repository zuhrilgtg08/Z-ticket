<?php

namespace App\Models;
use App\Models\Tiket;
use App\Models\Kota;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    protected $with = ['kota'];

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }

    public function kota()
    {
        return $this->hasMany(Kota::class);
    }
}
