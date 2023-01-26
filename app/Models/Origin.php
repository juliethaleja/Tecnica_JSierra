<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillabel=[
        'name',
        'url'
    ];
    protected $hidden=[
        'id_chararcter'
    ];
    public function Characters()
    {
        return $this->belongsTo(Characters::class);
    }
}
