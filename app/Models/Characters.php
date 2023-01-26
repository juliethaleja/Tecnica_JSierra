<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillabel=[
        'id_api',
        'name',
        'species',
        'status',
        'type',
        'gender',
        'image'
    ];
    protected $primaryKey='id_api';
    protected $with=array('Origin');
    public function Origin()
    {
        return $this->hasOne(Origin::class,'id_chararcter');
    }
}
