<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUsers extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'username', 'email', 'phone'];

    public function addresses()
    {
        return $this->hasOne(Addresses::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}


