<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-component')->layout('layouts.admin.app');
    }
}
