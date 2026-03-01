<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Contact;

class Modal extends Component
{
    public $contact;
    public $showModal = false;

    public function render()
    {
        return view('livewire.modal', ['contacts' => Contact::with('category')->get()]);
    }

    public function openModal($id)
    {
        $this->contact = Contact::with('category')->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

