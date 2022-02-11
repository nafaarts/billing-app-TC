@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Create Invoice</h2>
        <hr class="my-3">
        <form action="{{ route('invoice.store') }}" method="POST">
            @csrf

            <div class="mt-2">
                <label class="text-xs mb-1">Job Reference</label>
                <div
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400 flex items-center">
                    <div class="items text-sm"></div>
                    <input type="text" class="focus:outline-none" id="inputJobReference" placeholder="Enter Job Reference">
                </div>

                <input type="hidden" name="job_reference" id="job_reference">
                @error('job_reference')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
                <script>
                    let data = []
                    let oldData = "{{ old('job_reference') }}"
                    if (oldData) data = oldData.match(/[a-z0-9-]+/gi)
                    createItem()
                    let input = document.getElementById('inputJobReference')
                    input.addEventListener('keyup', (e) => {
                        if (e.key === "Spacebar" || e.key === " " || e.key === ",") {
                            if (!/^[\s]+/g.test(input.value)) {
                                data.push(input.value.trim().replace(/[,]|[\s]/g, ''))
                                input.value = ""
                                createItem()
                            }
                        }
                        if (e.keyCode == 8 && input.value.length == 0) {
                            data.pop()
                            createItem()
                        }
                    })

                    function createItem() {
                        document.querySelector('.items').innerHTML = ""
                        data.forEach(item => {
                            let node = document.createElement('span')
                            node.classList.add("bg-blue-200", "px-2", "py-1", "rounded-md", "mr-2")
                            node.textContent = item
                            document.querySelector('.items').append(node)
                        })
                        document.getElementById('job_reference').value = data.join(",")
                    }
                </script>
            </div>
            <div class="flex mt-2">
                <div class="w-1/2 pr-1">
                    <label class="text-xs mb-1">Draft No (optional)</label>
                    <input type="text" name="draft_no" id="draft_no" placeholder="Enter Draft Number"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('draft_no') }}">
                    @error('draft_no')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 pl-1">
                    <label class="text-xs mb-1">Due Date</label>
                    <input type="date" name="due_date" id="due_date" placeholder="Enter Due Date"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('due_date') }}">
                    @error('due_date')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
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
                    <label class="text-xs mb-1">Invoice Date</label>
                    <input type="date" name="date" id="date" placeholder="Enter Invoice Date"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('date') }}">
                    @error('date')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 flex pl-1">
                    <div class="w-1/2 pr-1">
                        <label class="text-xs mb-1">Terms</label>
                        <select name="terms" id="terms"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                            <option value="" disabled selected>Select Terms</option>
                            <option>7</option>
                            <option>15</option>
                            <option>30</option>
                            <option>45</option>
                            <option>60</option>
                            <option>90</option>
                            <option>COD</option>
                        </select>
                        @error('terms')
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
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Invoice Type</label>
                <select name="invoice_type" id="invoice_type"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                    <option value="invoice">Invoice</option>
                    <option value="reimbursment">Reimbursment</option>
                </select>
            </div>
            <fieldset class="flex mt-2 border border-gray-400 p-3 rounded-md" id="tax">
                <legend class="text-xs">Tax</legend>
                <div class="w-1/2 pr-1">
                    <label class="text-xs mb-1">Tax Invoice</label>
                    <input type="text" name="tax_invoice" id="tax_invoice" placeholder="Enter Tax Invoice"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('tax_invoice') }}">
                    @error('tax_invoice')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 pl-1">
                    <label class="text-xs mb-1">PPN</label>
                    <input type="number" name="ppn" id="ppn" placeholder="Enter PPN Value"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('ppn') }}">
                    @error('ppn')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </fieldset>
            <div class="flex mt-2">
                <div class="w-1/2 pr-1">
                    <label class="text-xs mb-1">Received By</label>
                    <input type="text" name="received_by" id="received_by" placeholder="Received By"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('received_by') }}">
                    @error('received_by')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 pl-1">
                    <label class="text-xs mb-1">Date Received</label>
                    <input type="date" name="date_received" id="date_received" placeholder="Date Received"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('date_received') }}">
                    @error('date_received')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Submit</button>
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
