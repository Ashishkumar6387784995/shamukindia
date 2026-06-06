<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'services_type';
    protected $fillable = ['name', 'service_type_parent_id'];

}
