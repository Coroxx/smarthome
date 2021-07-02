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
        'type'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
