<?php

namespace App\Livewire\Admin\User;

use App\Models\City;
use App\Models\Countries;
use App\Models\Roles;
use App\Models\ServiceType;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    // public $is_approved;
    public $states = [];
    public $cities = [];
    public $country_id;
    public $state_id;
    public $city_id;
    public $user_role;
    public $display_products_div = false;
    public $product_names = [];
    public $name;
    public $email;
    public $mobile;
    public $pan_number;
    public $pincode;
    public $password;
    public $address;
    public $profile_image;
    public $gender;
    public $organization;
    public $designation;
    public $department;
    public $branch;
    public $date_of_birth;

    public function stateChange()
    {
        $this->cities = City::where('state_id', $this->state_id)->get();
    }

    public function roleChange()
    {
        if ($this->user_role != '1' && $this->user_role != '3' && $this->user_role != '4' && $this->user_role != '5') {
            $this->display_products_div = true;
        } else {
            $this->display_products_div = false;
        }
    }

    public function checkProduct($id, $is_sub = 0)
    {
        $service_type = ServiceType::find($id);
        if ($is_sub == 0) {
            $service_type_sub = ServiceType::where('name', $service_type->name)->get();
            foreach ($service_type_sub as $sub) {
                if (!in_array($sub->id, $this->product_names)) {
                    $this->product_names[] = $sub->id;
                }
            }
        } else {
            if (!in_array($id, $this->product_names)) {
                $this->product_names[] = $id;
            }
        }
    }

    public function saveUser()
    {
        $this->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'mobile'      => 'required|digits:10|unique:users,mobile_number',
            'pan_number'  => 'nullable|string|max:10',
            'user_role'   => 'required|exists:roles,id',
            'state_id'    => 'required|exists:states,id',
            'city_id'     => 'required|exists:cities,id',
            'pincode'     => 'nullable|digits:6',
            'address'     => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|max:2048',
            'gender' => 'nullable',
            'organization' => 'nullable',
            'designation' => 'nullable',
            'department' => 'nullable',
            'branch' => 'nullable',
            'date_of_birth' => 'nullable|date',
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->pass_view = $this->password;
        $user->mobile_number = $this->mobile;
        $user->pan_number = $this->pan_number;
        $user->role_id = $this->user_role;
        $user->address = $this->address;
        $user->country_id = 105;
        $user->state_id = $this->state_id;
        $user->city_id = $this->city_id;
        $user->is_approved = 1;
        $user->pincode = $this->pincode;
        if ($this->user_role != '1' && $this->user_role != '3' && $this->user_role != '4' && $this->user_role != '5') {
            $user->assigned_products = json_encode($this->product_names);
        }
        if ($this->profile_image) {
            $path = $this->profile_image->store("profileImage", "public");
            $user->profile_image = $path;
        }

        $user->gender = $this->gender;
        $user->organization = $this->organization;
        $user->designation = $this->designation;
        $user->department = $this->department;
        $user->branch = $this->branch;
        $user->date_of_birth = $this->date_of_birth;

        $user->save();
        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    public function render()
    {
        $roles = Roles::where('status', 1)->get();
        $this->states = State::where('country_id', 105)->get();
        return view('livewire.admin.user.create', compact('roles'))->layout('layouts.admin.app');
    }
}
