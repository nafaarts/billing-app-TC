<?php

namespace App\Http\Controllers;

use App\Models\Remittance;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\RemittanceItem;
use App\Models\Wht;
use Illuminate\Support\Str;

class RemittanceController extends Controller
{
    public function index()
    {
        $title = "Remittance - Trans Continent";
        $data = Remittance::latest()->paginate(6);
        return view('remittance.remittance', ['title' => $title, 'remittances' => $data]);
    }

    public function create()
    {
        $title = "Create Remittance - Trans Continent";
        $banks = Bank::get();
        $clients = Client::get();
        return view('remittance.remittance-create', ['title' => $title, 'banks' => $banks, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client' => 'required',
            'bank_account' => 'required',
            'date' => 'required',
            'currency' => 'required'
        ]);

        $remittance_no = $this->createRemittanceNumber($request->client);

        Remittance::create([
            'remittance_no' => $remittance_no,
            'date' => $request->date,
            'bank_id' => $request->bank_account,
            'client_id' => $request->client,
            'currency' => $request->currency,
            'created_by' => auth()->user()->id
        ]);

        return redirect('remittance')->with('status', 'Remittance ' . collect(explode('-', $remittance_no))->implode('/') . ' successfully created');
    }

    private function createRemittanceNumber($client)
    {
        $client = Client::findOrFail($client);
        $month = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $count = Remittance::where('client_id', $client->id)->get()->count() + 1;
        $remittance_no = 'RMT-' . $client->company_code . '-' . $month[date('n')] . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        return $remittance_no;
    }

    public function detail(Remittance $remittance)
    {
        $title = collect(explode('-', $remittance->remittance_no))->implode('/') . ' - Trans Continent';
        return view('remittance.remittance-detail', ['title' => $title, 'remittance' => $remittance]);
    }

    public function getInvoices($client)
    {
        $relatedInvoices = Invoice::where('client_id', $client)->latest()->get();
        $relatedInvoices = collect($relatedInvoices)->map(function ($item) {
            return collect($item)->merge([
                'amount' => number_format($item->amount()),
                'amountWithPPN' => number_format($item->amountWithPPN()),
                'amountPPN' => number_format($item->amountWithPPN() - $item->amount()),
                'item_count' => $item->items->count() . ' ' . Str::plural('item', $item->items->count()),
                'user' => $item->userBy->name
            ])->except('description');
        });
        return response()->json($relatedInvoices, 200);
    }

    public function getWht($client)
    {
        $relatedWhts = Wht::where('client_id', $client)->latest()->get();
        $relatedWhts = collect($relatedWhts)->map(function ($item) {
            return collect($item)->merge(['reference_code_slash' => collect(explode('-', $item->reference_code))->implode('/')]);
        });
        return response()->json($relatedWhts, 200);
    }
}
