<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'item' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        Items::create([
            'item_detail' => $request->item,
            'price' => $request->price,
            'quantity' => $request->qty,
            'invoice_id' => $invoice->id,
            'services_id' => $request->service,
        ]);

        return redirect()->route('invoice.detail', $invoice)->with('status', 'New item added!');
    }

    public function update(Request $request)
    {
        $item = Items::findOrFail($request->id);
        $invoice = Invoice::findOrFail($item->invoice_id);

        $this->validate($request, [
            'item' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        $item->update([
            'item_detail' => $request->item,
            'price' => $request->price,
            'quantity' => $request->qty,
            'services_id' => $request->service,
        ]);

        return redirect()->route('invoice.detail', $invoice)->with('status', 'Item updated!');
    }

    public function destroy(Items $item)
    {
        $invoice = Invoice::findOrFail($item->invoice_id);
        $item->delete();
        return redirect()->route('invoice.detail', $invoice)->with('status', 'Item deleted!');
    }
}
