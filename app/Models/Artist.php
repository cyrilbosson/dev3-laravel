<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'firstname', 'birthdate', 'country_id', 'user_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hasDirected()
    {
        return $this->hasMany(Movie::class, 'director_id');
    }

    public function hasPlayed()
    {
        return $this->belongsToMany(Movie::class)->withPivot('role_name');
    }

    /**
     * Mutator: uppercase name
     */
    public function setNameAttribute($input)
    {
        $this->attributes['name'] = strtoupper($input);
    }

    public function getNameAttribute($input)
    {
        return strtoupper($input);
    }
}
