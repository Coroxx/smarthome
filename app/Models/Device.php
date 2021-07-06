<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'name',
        'user_id',
        'type',
        'username',
        'password'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}