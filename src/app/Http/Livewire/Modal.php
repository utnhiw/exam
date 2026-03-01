<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Livewire\WithPagination;

class Modal extends Component
{
    use WithPagination;

    public $contact;
    public $showModal = false;

    public function render()
    {
        // if (request()->input('action') === 'reset') {
        //     return redirect('/admin');
        // }

        // $query = Contact::with('category');
        // $contacts = $query->search(request()->all())->paginate(7)->withQueryString();
        // $categories = Category::all();

        // return view('admin', compact('contacts', 'categories'));
        return view('livewire.modal', ['contacts' => Contact::with('category')->paginate(7)]);
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

    // public function destroy(Request $request)
    // {
    //     Contact::find($request->id)->delete();
    //     $this->closeModal();

    //     return view('admin');
    // }
}

