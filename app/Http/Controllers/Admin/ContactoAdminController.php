<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactoAdminController extends Controller
{
    public function index()
    {
        $contactos = Contact::latest()->paginate(20);
        return view('admin.contactos.index', compact('contactos'));
    }

    public function marcarLeido(Contact $contact)
    {
        $contact->update(['leido' => true]);
        return redirect()->route('admin.contactos.index')->with('success', 'Marcado como leído.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contactos.index')->with('success', 'Contacto eliminado.');
    }
}
