@extends('_layouts.master')

@section('body')
    <section class="flex justify-between">
        <a href="{{ route('remittance') }}"
            class="py-2 px-4 text-sm font-medium text-gray-900 rounded-lg border hover:text-red-700">
            <i class="fas fa-fw fa-arrow-left"></i>
            Back to remittances
        </a>

        <div class="inline-flex rounded-lg shadow-sm" role="group">
            <a href="/"
                class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-l-lg border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                <i class="fas fa-fw fa-print"></i>
                Print Remittance
            </a>
            <a href="/"
                class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-r-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                <i class="fas fa-fw fa-cog"></i>
                Settings
            </a>
        </div>
    </section>

    <section class="bg-white rounded-lg overflow-hidden mt-3 p-2">
        <div class="flex justify-between">
            <div class="w-fit p-4 flex m-4">
                <table>
                    <tr>
                        <td colspan="3" class="font-bold">PT TRANS CONTINENT</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font-bold pb-3">DETAIL RECEIVED</td>
                    </tr>
                    <tr>
                        <td>FROM</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">
                            {{ $remittance->client->company_name }}</td>
                    </tr>
                    <tr>
                        <td>AMOUNT</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">{{ $remittance->currency == 'Rupiah' ? 'Rp' : '$' }}
                            {{ number_format($remittance->amount()) }}</td>
                    </tr>
                </table>
            </div>
            <div class="invoice-detail m-4 p-4 text-sm flex flex-col justify-items-end">
                <h3 class="text-xl text-right mb-4">REMITTANCE NO :
                    <strong>{{ collect(explode('-', $remittance->remittance_no))->implode('/') }}</strong>
                </h3>
                <table>
                    <tr>
                        <td class="text-right">Date</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">{{ $remittance->date }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Voucher</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">
                            {{ $remittance->bank->bank_detail }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Currency</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">{{ $remittance->currency }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="p-2">
            <div class="items">
                <table class="min-w-full rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                #</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Detail</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Rate</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                total</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Net Amount</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($remittance->items as $item)
                            <tr class="invoiceItems">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->invoice->invoice_no }}
                                    </div>
                                    <div class="text-xs leading-5 text-gray-500">
                                        *{{ $item->remarks }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ number_format($item->invoice->amount()) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $item->invoice->invoice_type == 'reimbursment' ? 'ZERO' : 'STANDARD' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ number_format($item->invoice->amountWithPPN()) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        + {{ $remittance->currency == 'Rupiah' ? 'Rp' : '$' }}
                                        {{ number_format($item->invoice->amountWithPPN() - $item->invoice->amount()) }}
                                        {{ number_format($item->invoice->ppn) }}%
                                        VAT
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ number_format($item->net_amount) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        + {{ $remittance->currency == 'Rupiah' ? 'Rp' : '$' }}
                                        {{ number_format($item->pph_tax) }}
                                        PPh
                                        23
                                    </div>
                                </td>


                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">

                                    <a data-id="1" class="text-gray-600 hover:text-gray-900 cursor-pointer"><i
                                            class="fas fa-fw fa-edit"></i></a>
                                    <form action="/" method="POST" class="inline"
                                        onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-600 hover:text-gray-900"><i
                                                class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="flex mt-3 justify-end p-3">
                <div class="tax-detail w-1/3  text-sm">
                    <table class="w-full">
                        <tr>
                            <td>TOTAL</td>
                            <td class="text-right font-bold">{{ number_format($remittance->amount()) }}</td>
                        </tr>
                        <tr>
                            <td>PAY OUT</td>
                            <td class="text-right">{{ number_format($remittance->payOut()) }}</td>
                        </tr>
                        <tr>
                            <td>GAP ( caption here! )</td>
                            <td class="text-right border-gray-700">
                                {{ number_format($remittance->payOut() - $remittance->amount()) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <section class="bg-white rounded-lg overflow-hidden mt-3 p-2">
        <div class="description p-3 m-2">
            <p class="mb-3"><i class="fas fa-fw fa-plus-circle"></i> Add Remittance Item</p>
            <form action="{{ route('remittance-item.add', $remittance) }}" method="POST">
                @csrf
                <div x-data="remittanceConfigs()" x-init="fetchData()">
                    <div class="border border-gray-200 p-2 rounded-md">
                        <input type="text" name="invoice_no" id="invoice_no" @click="open = !open"
                            x-bind:placeholder="getPlaceholder()" x-model="filter"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md border border-gray-200">
                        <small class="text-gray-400"></small>
                        <div class="mt-2 max-h-48 overflow-y-auto" x-show="open">
                            <template x-for="(invoice, index) in filteredOptions()" :key="index">
                                <div class="border border-gray-200 rounded-md hover:bg-red-500 p-2 mb-2 w-full cursor-pointer hover:text-white"
                                    @click="select(invoice.invoice_no)" x-bind:data-filter="invoice.invoice_no"
                                    :class="isSelected(invoice.invoice_no)">
                                    <div class="flex">
                                        <div class="w-1/5 pl-2 flex items-center">
                                            <h3 class="text-xl font-bold" x-text="invoice.invoice_no"></h3>
                                        </div>
                                        <div class="w-1/5 pl-2">
                                            <p class="text-xs">Amount : <span class="font-bold"
                                                    x-text="invoice.amount"></span></p>
                                            <p class="text-xs">VAT : <span class="font-bold"
                                                    x-text="invoice.ppn"></span> %
                                                - <span class="font-bold" x-text="invoice.amountPPN"></p>

                                        </div>
                                        <div class="w-1/5 pl-2">
                                            <p class="text-xs">Amount + VAT : <span class="font-bold"
                                                    x-text="invoice.amountWithPPN"></span></p>
                                            <p class="text-xs">Items : <span class="font-bold"
                                                    x-text="invoice.item_count"></span></p>
                                        </div>
                                        <div class="w-1/5 pl-2">
                                            <p class="text-xs">Job Ref : <span class="font-bold"
                                                    x-text="invoice.job_reference"></span></p>
                                            <p class="text-xs">Terms : <span class="font-bold"
                                                    x-text="invoice.terms">
                                            </p>
                                        </div>
                                        <div class="w-1/5 pl-2">
                                            <p class="text-xs">Date : <span class="font-bold"
                                                    x-text="invoice.date"></span>
                                            </p>
                                            <p class="text-xs">Due Date : <span class="font-bold"
                                                    x-text="invoice.due_date"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="flex mt-2 p-4 border border-gray-200 rounded-md"
                        x-show="Object.keys(selected).length !== 0">
                        <div class="w-1/2">
                            <p class="text-lg my-1 font-bold mb-3">Invoice No : <span x-text="selected.invoice_no"></span>
                            </p>
                            <p class="text-sm my-1">Type : <span class="font-bold uppercase"
                                    x-text="selected.invoice_type"></span>
                            </p>
                            <p class="text-sm my-1">Amount : <span class="font-bold"
                                    x-text="selected.amount "></span>
                                of <span class="font-bold" x-text="selected.item_count"></span></p>
                            <p class="text-sm my-1">VAT : <span class="font-bold"
                                    x-text="selected.amountPPN"></span>
                                ( <span class="font-bold" x-text="selected.ppn"></span>% )</p>
                            <p class="text-sm my-1">Amount + VAT : <span class="font-bold"
                                    x-text="selected.amountWithPPN"></span></p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm my-1">Job Ref : <span class="font-bold"
                                    x-text="selected.job_reference"></span>
                            </p>
                            <p class="text-sm my-1">Terms : <span class="font-bold" x-text="selected.terms">
                            </p>
                            <p class="text-sm my-1">Date : <span class="font-bold" x-text="selected.date"></span>
                            </p>
                            <p class="text-sm my-1">Due Date : <span class="font-bold"
                                    x-text="selected.due_date"></span>
                            </p>
                            <p class="text-sm my-1">Created By : <span class="font-bold"
                                    x-text="selected.user"></span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 flex">
                        <label
                            class="flex w-1/2 mr-1 items-center cursor-pointer border border-gray-200 rounded-md py-2 px-4"
                            for="wapu">
                            <input type="checkbox" value="1" name="wapu" id="wapu">
                            <span class="text-sm ml-3">VAT WAPU (Wajib Pungut)</span>
                        </label>
                        <label
                            class="flex w-1/2 ml-1 items-center cursor-pointer border border-gray-200 rounded-md py-2 px-4"
                            for="wht">
                            <input type="checkbox" value="1" name="wht" id="wht"
                                x-on:click="whtStatus = !whtStatus; openWht = false; whtFilter = ''">
                            <span class="text-sm ml-3">WHT (Withholding Tax)</span>
                        </label>
                    </div>

                    <div class="mt-2">
                        <label class="text-xs mb-1">WHT Documents</label>
                        <input type="text" name="wht_document" id="wht_document" placeholder="search WHTs"
                            x-model="whtFilter"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md border border-gray-200"
                            x-on:click="openWht = !openWht" x-bind:disabled="whtStatus">
                        <div class="mt-2 max-h-48 overflow-y-auto px-2 py-1 border border-gray-200 rounded-md"
                            x-show="openWht">
                            <template x-for="(item, index) in whtSearch()" :key="index">
                                <div x-on:click="whtFilter = item.reference_code_slash; openWht = false"
                                    :class="whtFilter == item.reference_code_slash ? 'bg-red-500 text-white' : ''"
                                    class="border border-gray-200 rounded-md hover:bg-red-700 p-2 my-1 w-full cursor-pointer hover:text-white">
                                    <p class=""
                                        x-text="item.reference_code_slash + ' ( ' + item.percentage + '% )'"></p>
                                </div>
                            </template>
                            <a href="{{ route('wht.create') }}" class="text-xs mb-1 hover:text-red-400"><i
                                    class="fas fa-fw fa-arrow-right"></i> Create WHT
                                document?</a>
                        </div>
                        @error('wht_document')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex mt-2">
                        <div class="w-1/2 pr-1">
                            <label class="text-xs mb-1">Kurs</label>
                            <input type="number" name="kurs" id="kurs" placeholder="Enter today kurs"
                                class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-200"
                                value="{{ old('kurs') }}" x-bind:value="kurs">
                            <small @click="getKurs()" class="text-xs italic cursor-pointer hover:text-red-700"><i
                                    class="fas fa-fw fa-refresh"></i> get
                                kurs SGD to IDR ( from freecurrencyapi.net )</small>
                            @error('kurs')
                                <small class="text-sm text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2 pl-1">
                            <label class="text-xs mb-1">SSP LB 1 & 3 Date</label>
                            <input type="date" name="ssp_lb_date" id="ssp_lb_date" placeholder="Enter SSP LB date (if any)"
                                class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-200"
                                value="{{ old('ssp_lb_date') }}">
                            @error('ssp_lb_date')
                                <small class="text-sm text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="flex mt-2">
                        <div class="w-1/2 pr-1">
                            <label class="text-xs mb-1">PPh 23</label>
                            <input type="number" name="pph" id="pph" placeholder="Enter PPh 23"
                                class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-200"
                                value="{{ old('pph') }}">
                            @error('pph')
                                <small class="text-sm text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2 pl-1">
                            <label class="text-xs mb-1">Administration / Other</label>
                            <input type="number" name="administration" id="administration"
                                placeholder="Enter administration cost (if any)"
                                class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-200"
                                value="{{ old('administration') }}">
                            @error('administration')
                                <small class="text-sm text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="text-xs mb-1">Net Amount</label>
                        <input type="number" name="net_amount" id="net_amount" placeholder="Enter net amount"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                            value="{{ old('net_amount') }}">
                        @error('net_amount')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="mt-2">
                        <label class="text-xs mb-1">Remarks</label>
                        <textarea name="remarks" placeholder="Enter remarks if any (optional)"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-200">{{ old('remarks') }}</textarea>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" x-bind:disabled="Object.keys(selected).length === 0"
                            class="px-4 py-2 text-sm bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700"><i
                                class="fas fa-fw fa-add"></i> Add
                            Item</button>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <script>
        function remittanceConfigs() {
            return {
                filter: "",
                whtFilter: "",
                data: null,
                wht: null,
                selected: {},
                open: false,
                openWht: false,
                whtStatus: true,
                kurs: null,
                fetchData() {
                    fetch('http://localhost:8000/getInvoices/{{ $remittance->client_id }}')
                        .then(response => response.json())
                        .then(data => {
                            this.data = JSON.parse(JSON.stringify(data))
                        })
                    fetch('http://localhost:8000/getWht/{{ $remittance->client_id }}')
                        .then(response => response.json())
                        .then(data => {
                            this.wht = JSON.parse(JSON.stringify(data))
                        })
                },
                filteredOptions() {
                    return this.filter ? this.data.filter(item => item.invoice_no.toUpperCase().indexOf(this.filter
                        .toUpperCase()) !== -1) : this.data
                },
                select(value) {
                    this.filter = value
                    this.open = false
                    this.getSelected(value)
                    console.log(JSON.parse(JSON.stringify(this.selected)))
                },
                isSelected(value) {
                    return value === this.filter ? 'bg-red-500 text-white' : ''
                },
                getSelected(value) {
                    this.selected = JSON.parse(JSON.stringify(this.data.filter(item => {
                        return item.invoice_no == value
                    })[0]))
                },
                getPlaceholder() {
                    return 'Search from ' + (this.data ? this.data.length : 0) + ' invoices'
                },
                getSelectedData() {
                    return JSON.parse(JSON.stringify(this.selected))
                },
                getKurs() {
                    let url =
                        "https://freecurrencyapi.net/api/v2/latest?apikey=e0de1860-8471-11ec-a8fc-d9052a1efdc6&base_currency=SGD"
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            this.kurs = parseInt(data.data.IDR)
                        })
                },
                whtSearch() {
                    return !this.whtFilter ? this.wht : this.wht.filter(item => item.reference_code_slash.toUpperCase()
                        .indexOf(
                            this.whtFilter.toUpperCase()) !== -1)

                }
            }
        }
    </script>
@endsection
