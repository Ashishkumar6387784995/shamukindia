<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'countryCode',
        'name',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
