<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Remittance;
use App\Models\RemittanceItem;
use App\Models\Wht;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RemittanceItemController extends Controller
{
    public function store(Request $request, $remittance)
    {
        $invoiceData = Invoice::where('invoice_no', $request->invoice_no)->get()->first();
        $remittanceData = Remittance::where('remittance_no', $remittance)->get()->first();

        $this->validate($request, [
            'invoice_no' => 'required',
            'net_amount' => 'required',
            'kurs' => 'required',
            'wht_document' => Rule::requiredIf($request->wht == 1),
            'ssp_lb_date' => Rule::requiredIf($request->wapu == 1)
        ]);

        $wht_id = null;
        if ($request->wht_document) $wht_id = Wht::where('reference_code', collect(explode('/', $request->wht_document))->implode('-'))->get()->first()->id;

        $data = [
            'remittance_id' => $remittanceData->id,
            'invoice_id' => $invoiceData->id,
            'pph_tax' => $request->pph ?? 0,
            'net_amount' => $request->net_amount,
            'remarks' => $request->remarks,
            'kurs' => $request->kurs,
            'wapu' => $request->wapu ?? '0',
            'wht' => $request->wht,
            'wht_id' => $request->wht == 1 ? $wht_id : null,
            'adm_other' => $request->administration ?? 0,
            'ssp_lb_date' => $request->wapu == 1 ? $request->ssp_lb_date : null,
        ];

        // dd($request, $data);

        RemittanceItem::create($data);

        return redirect()->route('remittance.detail', $remittance);
    }
}
