<?php

namespace App\Livewire\Admin\Lead;

use App\Models\City;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $clients = [];
    public $service_types = [];
    public $city = [];
    public $client = '';
    public $service_type = '';
    public $purpose = '';
    public $borrower_name = '';
    public $contact_name = '';
    public $contact_number = '';
    public $registration_number = '';
    public $city_id = '';
    public $remark = '';
    public $documents = [];
    

    public function mount(){
        $this->clients = User::where('role_id', 3)->get();
        $this->city = City::all();
        $this->service_types = json_decode(Auth::user()->assigned_products, true);
    }

    public function serviceTypeChange(){
        if($this->service_type == 'Valuation - Valuation Of  Car'){
            $this->dispatch('displayRegisterNumber');
        }
    }

    public function store(){
        $validator = Validator::make($this->all(),[
            'client' => 'required',
            'service_type' => 'required',
            'purpose' => 'required',
            'borrower_name' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'registration_number' => 'required_if:service_type,Valuation - Valuation Of  Car',
            'city_id' => 'required',
            'remark' => 'sometimes',
            'documents' => 'required',
        ]);

        $lead = new Lead();
        $lead->client_id = $this->client;
        $lead->service_type = $this->service_type;
        $lead->purpose = $this->purpose;
        $lead->borrower_name = $this->borrower_name;
        $lead->contact_name = $this->contact_name;
        $lead->contact_number = $this->contact_number;
        $lead->registration_number = $this->registration_number;
        $lead->city = $this->city_id;
        $lead->remarks = $this->remark;
        $documents = [];
        if($this->documents && count($this->documents) > 0){
            foreach ($this->documents as $key => $document) {
                $documents[] = $document->store('documents', 'public');
            }
        }
        $lead->documents = json_encode($documents);
        $lead->created_by = Auth::user()->id;
        $lead->save();

        generate_log($lead->id, 'Lead Created', Auth::user()->id);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully');
    }

    public function render()
    {
        return view('livewire.admin.lead.create')->layout('layouts.admin.app');
    }
}
