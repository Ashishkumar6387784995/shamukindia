<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadStatusChanges extends Model
{
    use SoftDeletes;
    protected $table = 'lead_status_changes';
    protected $fillable = [
        'lead_id',
        'status',
        'appointed_date_time',
        'appointed_place',
        'professional_fees',
        'executive_charges',
        'remarks',
        'executive_message', 
        'executive_id',
        'mode_of_payment'
    ]; 

    public function getExecutive(){
        return $this->belongsTo(User::class, 'executive_id', 'id');
    }
}
