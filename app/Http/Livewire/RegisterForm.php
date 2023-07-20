<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegisterForm extends Component
{
    public $email = '', $password = '', $first_name = '', $last_name = '', $company_name = '', $vat_number = '';
    public $role  = 'customer';

    protected $rules = [
        'first_name'   => ['required', 'min:2'],
        'last_name'    => ['required', 'min:2'],
        'email'        => ['required', 'email'],
        'password'     => ['required', 'min:6'],
        'company_name' => ['required_if:role,vendor'],
        'vat_number'   => ['required_if:role,vendor'],
    ];

    public function submit()
    {
        $this->validate();

        // Register customer
        session()->flash('message', "{$this->role} was created.");

        $this->email        = '';
        $this->password     = '';
        $this->first_name   = '';
        $this->last_name    = '';
        $this->role         = $this->role;
        $this->company_name = '';
        $this->vat_number   = '';
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
