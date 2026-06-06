<?php

namespace App\Livewire\Admin\ServiceType;

use App\Models\ServiceType;
use Livewire\Component;

class Index extends Component
{
    public $name = "";
    public $parent_id = null;
    public $sub_category_id = null;
    public $id = "";
    public $service_types_parent = [];

    public function createServiceType()
    {
        if ($this->id != '') {
            $service_type = ServiceType::find($this->id);
        } else {
            $service_type = new ServiceType();
        }
        $service_type->name = $this->name;
        $service_type->service_type_parent_id = $this->parent_id;
        $service_type->sub_category_id = $this->sub_category_id;
        $service_type->save();
        return redirect()->route('service-type.index')->with('success', 'Service Type Created Successfully');
    }

    public function editServiceType($id)
    {
        $this->id = $id;
        $service_type = ServiceType::find($id);
        $this->name = $service_type->name;
        $this->parent_id = $service_type->service_type_parent_id;
        $this->sub_category_id = $service_type->sub_category_id;
        $this->dispatch('open-model');
    }

    public function render()
    {
        $this->service_types_parent = ServiceType::all();
        $service_types = ServiceType::orderBy('name', 'asc')->paginate(10);
        return view('livewire.admin.service-type.index', compact('service_types'))->layout('layouts.admin.app');
    }
}
