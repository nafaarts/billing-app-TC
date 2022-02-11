@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Create Remittance</h2>
        <hr class="my-3">
        <form action="{{ route('remittance.store') }}" method="POST">
            @csrf
            <div class="flex mt-2">
                <div class="w-1/2 pr-1">
                    <label class="text-xs mb-1">Client</label>
                    <select name="client" id="client"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                        <option value="" disabled selected>Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->company_name }} (
                                {{ $client->company_code }} )
                            </option>
                        @endforeach
                    </select>
                    @error('client')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 pl-1">
                    <label class="text-xs mb-1">Bank Account</label>
                    <select name="bank_account" id="bank_account"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                        <option value="" disabled selected>Select Bank Account</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->bank_detail }} ( {{ $bank->bank_name }} )
                            </option>
                        @endforeach
                    </select>
                    @error('bank_account')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="flex mt-2">
                <div class="w-1/2 pr-1">
                    <label class="text-xs mb-1">Date</label>
                    <input type="date" name="date" id="date" placeholder="Enter Remittance Date"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('date') }}">
                    @error('date')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 pl-1">
                    <label class="text-xs mb-1">Currency</label>
                    <select name="currency" id="currency"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                        <option value="" disabled selected>Select Currency</option>
                        <option value="Rupiah">(Rp) Rupiah</option>
                        <option value="Dollar">($) Dollar</option>
                    </select>
                    @error('currency')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Create</button>
            </div>
        </form>
    </div>

    <script>
        let type = document.getElementById('invoice_type')
        document.getElementById('client').value = "{{ old('client') }}"
        document.getElementById('bank_account').value = "{{ old('bank_account') }}"
        document.getElementById('terms').value = "{{ old('terms') }}"
        document.getElementById('currency').value = "{{ old('currency') }}"

        toggleTax()
        type.addEventListener('change', toggleTax)

        function toggleTax() {
            document.getElementById('tax').classList.toggle('hidden', type.value === "reimbursment")
            document.getElementById('tax_invoice').value = ""
            document.getElementById('ppn').value = ""
        }
    </script>

@endsection
