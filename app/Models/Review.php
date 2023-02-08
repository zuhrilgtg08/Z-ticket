<?php

namespace App\Models;
use App\Models\User;
use App\Models\Tiket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
}
