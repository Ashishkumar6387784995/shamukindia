<?php

namespace App\Livewire\Admin\Lead;

use App\Models\Lead;
use App\Models\LeadStatusChanges;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $executive = [];
    public $lead_id;
    public $status;
    public $appointed_date;
    public $appointed_time;
    public $appointed_place;
    public $professional_fees;
    public $payment_mode;
    public $executive_charges;
    public $remarks;
    public $executive_id;
    public $executive_message;
    public $latest_lead_status = [];
    public $type = '';
    public $files = [];
    public $id = '';
    public $lead = null;

    public function settype($type, $id)
    {
        $this->type = $type;
        $this->id = $id;
        $this->lead = Lead::find($id);
        reset($this->files);
    }

    public function addFiles()
    {
        $validation = '';
        if($this->type == 'images'){
            $validation = 'image|mimes:jpeg,png,jpg,gif,svg,webp';
        }else if($this->type == 'documents'){
            $validation = 'mimes:pdf,doc,docx';
        }else if($this->type == 'videos'){
            $validation = 'mimes:mp4,avi,mkv,webm,mov,wmv';
        }else if($this->type == 'pdfs'){
            $validation = 'mimes:pdf';
        }


        $this->validate([
            'files' => 'required|array|min:1',
            'files.*' => $validation
        ]);

        if (isset($this->files) && count($this->files) > 0) {
            $lead = Lead::find($this->id);
            $type = $this->type;
            $files_name = json_decode($lead->$type, true);
            foreach ($this->files as $file) {
                $files_name[] = $file->store('documents', 'public');
            }

            $lead->$type = json_encode($files_name);
            $lead->save();
            
            return redirect()->route('leads.index');
        }
    }

    public function setLead($id)
    {
        $this->lead_id = $id;
        $lead = Lead::find($id);
        $this->executive = User::where('assigned_products', 'like', '%' . $lead->service_type . '%')->where('role_id', '!=', 1)->where('role_id', "!=", 4)->where('role_id', "!=", 3)->get();
        $this->latest_lead_status = [];
        $this->latest_lead_status = LeadStatusChanges::where('lead_id', $id)->orderBy('id', 'desc')->first();
        $this->status = config('app.leads')[$this->latest_lead_status['status']];
        $this->appointed_date = Carbon::parse($this->latest_lead_status['appointed_date_time'])->format('Y-m-d H:i');
        $this->appointed_place = $this->latest_lead_status['appointed_place'];
        $this->professional_fees = $this->latest_lead_status['professional_fees'];
        $this->payment_mode = $this->latest_lead_status['mode_of_payment'];
        $this->executive_charges = $this->latest_lead_status['executive_charges'];
        $this->remarks = $this->latest_lead_status['remarks'];
        $this->executive_id = $this->latest_lead_status['executive_id'];
        $this->executive_message = $this->latest_lead_status['executive_message'];
    }


    public function render()
    {
        $leads = Lead::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.lead.index', compact('leads'))->layout('layouts.admin.app');
    }

    public function statusChange()
    {
        $this->status;
    }

    public function leadStatusSave()
    {
        $this->validate([
            'status' => 'required'
        ]);
        $leadStatus = new LeadStatusChanges();
        $leadStatus->lead_id = $this->lead_id;
        $leadStatus->status = array_search($this->status, config('app.leads'));
        $leadStatus->appointed_date_time = $this->appointed_date;
        $leadStatus->appointed_place = $this->appointed_place;
        $leadStatus->professional_fees = $this->professional_fees;
        $leadStatus->mode_of_payment = $this->payment_mode;
        $leadStatus->executive_charges = $this->executive_charges;
        $leadStatus->remarks = $this->remarks;
        $leadStatus->executive_id = $this->executive_id;
        $leadStatus->executive_message = $this->executive_message;
        $leadStatus->save();

        $lead = Lead::find($this->lead_id);
        $lead->status = array_search($this->status, config('app.leads'));
        if ($this->executive_id != null && $this->executive_id != '') {
            $lead->executer_id = $this->executive_id;
        }
        $lead->save();


        if ($this->executive_id) {
            $executive = User::find($this->executive_id);
            $message = 'Lead Status changed. Remarks: ' . $this->remarks .
                ' and Executive ' . $executive->name . ' is assigned for "' . $this->status . '". Status';
        } else {
            $message = 'Lead Status changed to ' . $this->status . '.';
        }
        generate_log($this->lead_id, $message, Auth::user()->id);
        return redirect()->route('leads.index')->with('success', 'Lead status change successfully!');
    }
}
