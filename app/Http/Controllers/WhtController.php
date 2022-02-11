<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Wht;
use Illuminate\Http\Request;

class WhtController extends Controller
{
    public function index()
    {
        $title = "WHT - Trans Continent";
        $whts = Wht::latest()->paginate(6);
        return view('wht.wht', ['title' => $title, 'whts' => $whts]);
    }

    public function create()
    {
        $title = "Create WHT - Trans Continent";
        $clients = Client::latest()->get();
        return view('wht.wht-create', ['title' => $title, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client' => 'required',
            'percentage' => 'required',
            'wht_document' => 'mimes:pdf'
        ]);

        $client = Client::findOrFail($request->client);
        $whts = Wht::where('client_id', $client->id)->get();
        $code = 'WHT-' . $client->company_code . '-' . ($whts->count() + 1);

        $data = [
            'client_id' => $client->id,
            'reference_code' => $code,
            'percentage' => $request->percentage,
            'wht_date' => $request->wht_date,
            'wht_number' => $request->wht_number,
        ];

        if ($request->hasFile('wht_document')) {
            $file = $request->file('wht_document')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $data['filename'] = $filename . '.' . $extension;
            $request->file('wht_document')->move('attachment/WHT/', $data['filename']);
        }

        Wht::create($data);

        return redirect('wht')->with('status', 'WHT successfully created!');
    }
}
