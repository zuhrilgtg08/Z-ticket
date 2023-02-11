<?php

namespace App\Models;
use App\Models\Tiket;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $guarded = ['id'];
    protected $table = 'hotel';
    use HasFactory, Sluggable;

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
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
