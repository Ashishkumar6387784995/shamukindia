<?php

namespace App\Livewire\Admin\User;

use App\Models\Roles;
use App\Models\ServiceType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $roles = [];
    public $id;
    public $role = "";
    public $product_names = [];

    public function mount()
    {
        $this->roles = Roles::where("id", "!=", 4)->where("id", "!=", 1)->get();
    }

    public function triggerPopup($id){
        $this->id = $id;
        $this->dispatch('triggerPopup');
    }

    public function approveUser()
    {
        $user = User::find($this->id);
        $user->is_approved = 1;
        $user->role_id = $this->role;
        if($this->role != '1' && $this->role != '3' && $this->role != '4' && $this->role != '5'){
            $user->assigned_products = json_encode($this->product_names);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User Approved Successfully');
    }

    public function assignRole(){
        if($this->role != '1' && $this->role != '3' && $this->role != '4' && $this->role != '5'){
            $this->dispatch('displayProducts');
        }else{
            $this->dispatch('hideProducts');
        }
    }

    public function checkProduct($id, $is_sub = 0){
       $service_type = ServiceType::find($id);
       if($is_sub == 0){
           $service_type_sub = ServiceType::where('name', $service_type->name)->get();
           foreach($service_type_sub as $sub){
               if(!in_array($sub->id, $this->product_names)){
                   $this->product_names[] = $sub->id;
               }
           }
       }else{
           if(!in_array($id, $this->product_names)){
               $this->product_names[] = $id;
           }
       }
    }

    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.admin.user.index', compact('users'))->layout('layouts.admin.app');
    }
}
