<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $title = "Bank Account - Trans Continent";
        $data = Bank::paginate(6);
        return view('bank.bank', ['data' => $data, 'title' => $title]);
    }

    public function create()
    {
        $title = "Create Bank Account - Trans Continent";
        return view('bank.bank-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account_name' => 'required',
            'bank_detail' => 'required',
            'account_number' => 'required',
            'currency' => 'required',
            'swift_code' => 'required',
            'bank_address' => 'required'
        ]);

        Bank::create([
            'bank_name' => $request->account_name,
            'bank_detail' => $request->bank_detail,
            'bank_address' => $request->bank_address,
            'bank_account_number' => $request->account_number,
            'bank_currency' => $request->currency,
            'swift_code' => $request->swift_code,
        ]);

        return redirect('bank-account')->with('status', 'Bank account successfully added!');
    }

    public function edit(Bank $bank)
    {
        $title = "Bank Account - Trans Continent";
        return view('bank.bank-edit', ['data' => $bank, 'title' => $title]);
    }

    public function update(Request $request, Bank $bank)
    {
        $this->validate($request, [
            'account_name' => 'required',
            'bank_detail' => 'required',
            'account_number' => 'required',
            'currency' => 'required',
            'swift_code' => 'required',
            'bank_address' => 'required'
        ]);

        $bank->update([
            'bank_name' => $request->account_name,
            'bank_detail' => $request->bank_detail,
            'bank_address' => $request->bank_address,
            'bank_account_number' => $request->account_number,
            'bank_currency' => $request->currency,
            'swift_code' => $request->swift_code,
        ]);

        return redirect('bank-account')->with('status', 'Bank account successfully updated!');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect('bank-account')->with('status', 'Bank account successfully deleted!');
    }
}
