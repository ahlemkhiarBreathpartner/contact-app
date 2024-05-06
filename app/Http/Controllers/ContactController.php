<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts   = Contact::orderBy("id", "desc")
            ->where(function ($query) {
                if ($companyId = request('company_id')) {
                    $query->where('company_id', $companyId);
                }
            })
            ->paginate(5);
        $companies =  Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '0');
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        $companies =  Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '0');

        return view('contacts.create', compact('companies'));
    }
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contacts.show', compact('contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);
        Contact::create($request->all());
        return redirect()->route('contacts.index')
            ->with("message", "Contact has been added successfully");
    }

    public function edit(Contact $contact)
    {


        $companies =  Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '0');
        return view("contacts.edit", compact('companies', 'contact'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);
        $contact = Contact::
        Contact::update($request->all());
        return redirect()->route('contacts.index')
            ->with("message", "Contact has been added successfully");
    }
}
