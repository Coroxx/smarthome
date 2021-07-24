<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'device_id', 'device_type', 'action', 'days', 'user_id'];


    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
