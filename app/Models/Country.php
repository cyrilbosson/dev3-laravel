<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
