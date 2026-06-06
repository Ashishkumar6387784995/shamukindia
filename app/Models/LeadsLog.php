<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadsLog extends Model
{
    protected $table = 'leads_logs';
    protected $protected = [
        'lead_id',
        'message',
        'executer_id'
    ];

    public function getLead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function getExecuter()
    {
        return $this->belongsTo(User::class, 'executer_id', 'id');
    }
}
