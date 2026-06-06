<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OTPS extends Model
{
    use SoftDeletes;
    protected $table = 'otps';

    protected $fillable = [
        'user_id',
        'otp',
        'status'
    ];

}
