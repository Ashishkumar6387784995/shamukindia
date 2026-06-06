<?php

namespace App\Livewire\Admin\Lead;

use App\Models\Lead;
use App\Models\LeadsLog;
use App\Models\LeadStatusChanges;
use Livewire\Component;

class Logs extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $logs = LeadsLog::where('lead_id', $this->id)->orderBy('id', 'desc')->paginate(10);
        $leads = Lead::where('id', $this->id)->first();
        $lead_status = LeadStatusChanges::where('lead_id', $this->id)->orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.lead.logs', compact('logs','leads','lead_status'))->layout('layouts.admin.app');
    }
}
