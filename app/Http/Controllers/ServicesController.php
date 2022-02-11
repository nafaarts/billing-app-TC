<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $data = Services::latest()->paginate(10);
        $title = "Services - Trans Continent";
        return view('services.services', ['title' => $title, 'services' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:services'
        ]);
        Services::create(['name' => $request->name]);
        return redirect('/services')->with('status', $request->name . ' successfully added!');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $services = Services::findOrFail($request->id);
        $services->update(['name' => $request->name]);
        return redirect('/services')->with('status', $request->name . ' successfully updated!');
    }

    public function destroy(Services $services)
    {
        $services->delete();
        return redirect('/services')->with('status', $services->name . ' successfully deleted!');
    }
}
