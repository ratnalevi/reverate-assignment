<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $fillable = ['street', 'city', 'suite', 'zip'];

    public function geo()
    {
        return $this->hasOne(Coordinates::class);
    }
}
