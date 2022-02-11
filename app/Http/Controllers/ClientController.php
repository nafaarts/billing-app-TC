<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $title = "Client - Trans Continent";
        $data = Client::paginate(6);
        return view('client.client', ['title' => $title, 'data' => $data]);
    }

    public function create()
    {
        $title = "Create Client - Trans Continent";
        return view('client.client-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_code' => 'required',
            'company_name' => 'required',
            'company_npwp' => 'required',
            'company_address' => 'required',
            'company_departement' => 'required',
        ]);

        Client::create([
            'company_code' => $request->company_code,
            'company_name' => $request->company_name,
            'company_npwp' => $request->company_npwp,
            'company_address' => $request->company_address,
            'company_departement' => $request->company_departement,
        ]);

        return redirect('client')->with('status', 'Client successfully added!');
    }

    public function edit(Client $client)
    {
        $title = "Edit Client - Trans Continent";
        return view('client.client-edit', ['title' => $title, 'data' => $client]);
    }

    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'company_code' => 'required',
            'company_name' => 'required',
            'company_npwp' => 'required',
            'company_address' => 'required',
            'company_departement' => 'required',
        ]);

        $client->update([
            'company_code' => $request->company_code,
            'company_name' => $request->company_name,
            'company_npwp' => $request->company_npwp,
            'company_address' => $request->company_address,
            'company_departement' => $request->company_departement,
        ]);

        return redirect('client')->with('status', 'Client successfully updated!');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('client')->with('status', 'Client successfully deleted!');
    }
}
