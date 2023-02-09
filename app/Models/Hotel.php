<?php

namespace App\Models;

use App\Models\Tiket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'hotel';

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
}
