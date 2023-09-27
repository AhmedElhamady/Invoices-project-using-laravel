<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceAchiveController extends Controller
{

    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('Invoices.Archive_Invoices', compact('invoices'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->invoice_id;
        Invoice::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
        $invoices = Invoice::withTrashed()->where('id', $request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Archive');
    }
}
