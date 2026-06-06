<?php

namespace App\Livewire\Admin\User;

use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $states = [];
    public $cities = [];
    public $country_id;
    public $state_id;
    public $city_id;
    public $user_role;
    public $name;
    public $email;
    public $mobile;
    public $pan_number;
    public $pincode;
    public $password;
    public $address;
    public $profile_image;
    public $previous_image;
    public $user;
    public $gender;
    public $organization;
    public $designation;
    public $department;
    public $branch;
    public $date_of_birth;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name         = $this->user->name;
        $this->email        = $this->user->email;
        $this->mobile       = $this->user->mobile_number;
        $this->pan_number   = $this->user->pan_number;
        $this->pincode      = $this->user->pincode;
        $this->address      = $this->user->address;
        $this->previous_image = $this->user->profile_image;

        $this->user_role    = $this->user->role_id;
        $this->country_id   = $this->user->country_id;
        $this->state_id     = $this->user->state_id;
        $this->city_id      = $this->user->city_id;

        $this->states = State::where('country_id', 105)->get();
        $this->cities = City::where('state_id', $this->state_id)->get();
        $this->gender       = $this->user->gender;
        $this->organization = $this->user->organization;
        $this->designation  = $this->user->designation;
        $this->department   = $this->user->department;
        $this->branch       = $this->user->branch;
        $this->date_of_birth = $this->user->date_of_birth;
    }

    public function stateChange()
    {
        $this->cities = City::where('state_id', $this->state_id)->get();
    }

    public function saveUser()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes',
            'mobile'   => 'required|digits:10|unique:users,mobile_number,' . $this->user->id,
            'pan_number'  => 'nullable|string|max:10',
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

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        if ($this->password) {
            $this->user->password = Hash::make($this->password);
            $this->user->pass_view = $this->password;
        }
        $this->user->mobile_number = $this->mobile;
        $this->user->pan_number = $this->pan_number;
        $this->user->role_id = $this->user_role;
        $this->user->address = $this->address;
        $this->user->country_id = 105;
        $this->user->state_id = $this->state_id;
        $this->user->city_id = $this->city_id;
        $this->user->is_approved = 1;
        $this->user->pincode = $this->pincode;
        $this->user->gender = $this->gender;
        $this->user->organization = $this->organization;
        $this->user->designation = $this->designation;
        $this->user->department = $this->department;
        $this->user->branch = $this->branch;
        $this->user->date_of_birth = $this->date_of_birth;
        // if ($this->user_role != '1' && $this->user_role != '3' && $this->user_role != '4' && $this->user_role != '5') {
        //     $this->user->assigned_products = json_encode($this->product_names );
        // }elseif($this->user_role == '1' || $this->user_role == '3' || $this->user_role == '4' || $this->user_role == '5' && $this->user->assigned_products != null){  
        //     $this->user->assigned_products = null;
        // }
        if ($this->profile_image) {
            $path = $this->profile_image->store("profileImage", "public");
            $this->user->profile_image = $path;
        }

        $this->user->save();
        return redirect()->route('users.index')->with('success', 'Profile Updated Successfully');
    }

    public function render()
    {
        return view('livewire.admin.user.profile')->layout('layouts.admin.app');
    }
}
