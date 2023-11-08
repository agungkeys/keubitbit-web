<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(Request $request)
    {
        $contact_query = Contact::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $contact_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $contact_query = $contact_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%")
                    ->orWhere('email', 'like', "%$searchParam%");
            });
        }
        $contacts = $contact_query->paginate(5);

        return view('admin.contacts', compact('contacts', 'sortColumn', 'sortDirection', 'searchParam'));
    }

    public function detail($id)
    {
        $contact = Contact::find($id);
        return response()->json([
            'status' => 200,
            'contact' => $contact
        ]);
    }
}
