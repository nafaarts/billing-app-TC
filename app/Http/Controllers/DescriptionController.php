<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'field' => 'required',
            'description' => 'required'
        ]);

        $data = collect($invoice->getDescription())->push(['field' => $request->field, 'description' => $request->description]);

        $invoice->update([
            'description' => $data
        ]);

        return redirect('invoice/' . $invoice->invoice_no . '/detail#invoice-description')->with('status', 'item successfully added!');
    }

    // public function update(Request $request, Invoice $invoice)
    // {
    //     $this->validate($request, [
    //         'field' => 'required',
    //         'description' => 'required'
    //     ]);
    //     dd($request, $invoice);
    // }

    public function destroy(Request $request, Invoice $invoice)
    {
        $result = collect();
        collect($invoice->getDescription())->each(function ($item) use ($result, $request) {
            if ($item->field != $request->field) $result->push($item);
        });

        $invoice->update([
            'description' => $result
        ]);

        return redirect('invoice/' . $invoice->invoice_no . '/detail#invoice-description')->with('status', 'item successfully deleted!');
    }
}
