<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $categories = Category::all();

        return view('confirm', compact('contact', 'categories'));
    }

    public function store(ContactRequest $request)
    {
        if ($request->input('action') === 'back') {
            return redirect('/')->withInput($request->all());
        }
        Contact::create($request->validated());

        return view('thanks');
    }

    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        if ($request->input('action') === 'reset') {
            return redirect('/admin');
        }
        $contacts = Contact::with('category')->search($request->all())->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return view('admin');
    }
}
