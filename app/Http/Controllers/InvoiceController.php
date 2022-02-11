<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    public function index()
    {
        $title = "Invoice - Trans Continent";
        $data = Invoice::latest()->paginate(6);
        return view('invoice.invoice', ['title' => $title, 'invoices' => $data]);
    }

    public function detail(Invoice $invoice)
    {

        $title = $invoice->invoice_no . " - Trans Continent";
        $services = Services::get();
        return view('invoice.invoice-detail', ['title' => $title, 'invoice' => $invoice, 'attachmentJson' => $invoice->getAttachment->toJson(), 'services' => $services]);
    }

    public function create()
    {
        $title = "Create Invoice - Trans Continent";
        $banks = Bank::get();
        $clients = Client::get();
        return view('invoice.invoice-create', ['title' => $title, 'banks' => $banks, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "job_reference" => "required",
            "client" => "required",
            "bank_account" => "required",
            "date" => "required",
            "terms" => "required",
            "invoice_type" => "required",
            "tax_invoice" => Rule::requiredIf($request->invoice_type == "invoice"),
            "ppn" => Rule::requiredIf($request->invoice_type == "invoice"),
            "received_by" => "required",
            "date_received" => "required",
            "due_date" => "required",
            "currency" => "required"
        ]);

        Invoice::create([
            'invoice_no' => $this->createInvoiceNumber($request->invoice_type),
            'draft_no' => $request->draft_no,
            'date' => $request->date,
            'job_reference' => $request->job_reference,
            'terms' => $request->terms,
            'client_id' => $request->client,
            'bank_id' => $request->bank_account,
            'tax_invoice' => $request->tax_invoice,
            'ppn' => $request->ppn,
            'received_by' => $request->received_by,
            'received_date' => $request->date_received,
            'invoice_type' => $request->invoice_type,
            'created_by' => auth()->user()->id,
            'description' => "[]",
            "due_date" => $request->due_date
        ]);

        return redirect('invoice')->with('status', 'Invoice successfully created!');
    }

    public function print(Invoice $invoice)
    {
        $title = $invoice->invoice_no . " - Trans Continent";
        return view('invoice.invoice-print', ['title' => $title, 'invoice' => $invoice, 'attachmentJson' => $invoice->getAttachment->toJson()]);
    }

    public function edit(Invoice $invoice)
    {
        $title = "Invoice Setting - Trans Continent";
        $banks = Bank::get();
        $clients = Client::get();
        return view('invoice.invoice-settings', ['title' => $title, 'banks' => $banks, 'clients' => $clients, 'invoice' => $invoice]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            "job_reference" => "required",
            "client" => "required",
            "bank_account" => "required",
            "date" => "required",
            "terms" => "required",
            "invoice_type" => "required",
            "tax_invoice" => Rule::requiredIf($request->invoice_type == "invoice"),
            "ppn" => Rule::requiredIf($request->invoice_type == "invoice"),
            "received_by" => "required",
            "date_received" => "required",
            "due_date" => "required",
            "currency" => "required"
        ]);

        $invoice->update([
            'draft_no' => $request->draft_no,
            'date' => $request->date,
            'job_reference' => $request->job_reference,
            'terms' => $request->terms,
            'client_id' => $request->client,
            'bank_id' => $request->bank_account,
            'tax_invoice' => $request->tax_invoice,
            'ppn' => $request->ppn,
            'received_by' => $request->received_by,
            'received_date' => $request->date_received,
            'invoice_type' => $request->invoice_type,
            "due_date" => $request->due_date
        ]);

        return redirect()->route('invoice.detail', $invoice)->with('status', 'Invoice successfully updated!');
    }

    private function createInvoiceNumber($type)
    {
        $invoices = Invoice::where('invoice_type', $type)->latest()->get()->first();
        $latest = explode('-', $invoices->invoice_no);
        $index = $type == 'reimbursment' ? 2 : 1;
        $latest[$index] = $latest[$index + 1] == date('Y') ? ((int) $latest[$index]) + 1 : 1;
        $latest[$index + 1] = date('Y');
        return collect($latest)->implode('-');
    }
}
