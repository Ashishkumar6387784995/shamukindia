<?php

namespace App\Livewire\Admin\Role;

use App\Models\Roles;
use Livewire\Component;

class Index extends Component
{
    public $roles = [];
    public $name = "";
    public $id = "";

    public function render()
    {
        $this->roles = Roles::all();
        return view('livewire.admin.role.index')->layout('layouts.admin.app');
    }

    public function changeStatus($id)
    {
        $role = Roles::find($id);
        $role->status = $role->status == 1 ? 0 : 1;
        $role->save();
    }

    public function createRole()
    {
        if ($this->id != '') {
            $role = Roles::find($this->id);
        } else {
            $role = new Roles();
        }

        $role->name = $this->name;
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role Created Successfully');
    }

    public function editRole($id)
    {
        $this->id = $id;
        $role = Roles::find($id);
        $this->name = $role->name;
        $this->dispatch('open-model');
    }
}
