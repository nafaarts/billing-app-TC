@extends('_layouts.master')

@section('body')
    <section class="flex justify-between">
        <a href="{{ route('invoice') }}"
            class="py-2 px-4 text-sm font-medium text-gray-900 rounded-lg border hover:text-red-700">
            <i class="fas fa-fw fa-arrow-left"></i>
            Back to invoices
        </a>

        <div class="inline-flex rounded-lg shadow-sm" role="group">
            <a href="{{ route('invoice.print', $invoice) }}"
                class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-l-lg border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                <i class="fas fa-fw fa-print"></i>
                Print invoice
            </a>
            <a href="{{ route('invoice.edit', $invoice) }}"
                class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-r-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                <i class="fas fa-fw fa-cog"></i>
                Settings
            </a>
        </div>
    </section>

    <section class="bg-white rounded-lg overflow-hidden mt-3" id="invoice-detail">
        <div class="flex justify-between">
            <div class="w-fit">
                <div class="client m-4 p-4">
                    <h3 class="font-bold">{{ $invoice->client->company_name }}</h3>
                    <hr class="my-2">
                    <p class="text-sm text-gray-500 whitespace-pre-line -mt-5">
                        {{ $invoice->client->company_address }}
                    </p>
                    <h5 class="font-bold mt-2">Attn : {{ $invoice->client->company_departement }}</h5>
                </div>
            </div>
            <div class="invoice-detail m-4 p-4 text-sm flex flex-col justify-items-end">
                <h3 class="text-xl text-right mb-4">INVOICE NO : <strong>{{ $invoice->invoice_no }}</strong></h3>
                <table>
                    <tr>
                        <td class="text-right">Date</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">{{ $invoice->date }}</td>
                    </tr>
                    <tr>
                        <td class="text-right align-top">Job Ref</td>
                        <td class="px-3 align-top">:</td>
                        <td class="font-bold" id="job_reference"></td>
                        <script>
                            document.getElementById('job_reference').innerHTML = "{{ $invoice->job_reference }}".replace(/[,]/g, '<br>');
                        </script>
                    </tr>
                    <tr>
                        <td class="text-right">Terms</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">
                            {{ $invoice->terms == 'COD' ? $invoice->terms : $invoice->terms . ' Days' }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Due Date</td>
                        <td class="px-3">:</td>
                        <td class="font-bold">{{ $invoice->due_date ? $invoice->due_date : '-' }}</td>
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
                                Detail of charges</th>

                            <th
                                class="px-6 py-3 border-b w-56 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Category</th>

                            <th
                                class="px-6 py-3 border-b w-52 border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Price</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Amount</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($invoice->items as $item)
                            <tr class="invoiceItems">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->item_detail }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ $item->service->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900 whitespace-pre-line -mt-5">
                                        {{ number_format($item->price) }} ({{ $item->quantity }})
                                    </div>
                                </td>


                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ number_format($item->price * $item->quantity) }}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">

                                    <a data-id="{{ $item->id }}"
                                        class="text-gray-600 hover:text-gray-900 cursor-pointer"><i
                                            class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('item.delete', $item) }}" method="POST" class="inline"
                                        onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-600 hover:text-gray-900"><i
                                                class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                        <form action="{{ route('item.add', $invoice) }}" method="POST">
                            <tr>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $invoice->items->count() + 1 }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    @csrf
                                    <input type="text" placeholder="Add new item..." name="item"
                                        class="form-input w-full text-xs focus:outline-none" value="{{ old('item') }}">
                                    @error('item')
                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                    @enderror
                                </td>

                                <td class="px-6 py-4 border-b border-gray-200 ">
                                    <select class="text-xs" name="service" id="service">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="px-6 py-4 border-b border-gray-200 ">
                                    <div class="flex">
                                        <input type="number" placeholder="Price" name="price" id="priceAdd"
                                            class="form-input w-2/3 m-0 text-xs focus:outline-none"
                                            value="{{ old('price') }}" onkeyup="getAddSum()"> <span
                                            class="text-gray-500 px-1">*</span>
                                        <input type="number" placeholder="Qty" name="qty" id="qtyAdd"
                                            class="form-input w-1/3 m-0 text-xs focus:outline-none"
                                            value="{{ old('qty') }}" onkeyup="getAddSum()">
                                    </div>
                                    @error('price')
                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                    @enderror
                                    @error('qty')
                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                    @enderror
                                </td>


                                <td class="px-6 py-4 border-b border-gray-200 ">
                                    <div class="text-xs text-gray-900 font-bold" id="amountAdd">
                                        {{ number_format(0) }}
                                    </div>
                                </td>
                                <td class="border-b border-gray-200 text-sm font-medium pl-4">
                                    <button type="submit"
                                        class="px-2 rounded-sm py-1 text-xs bg-gray-800 text-gray-200 hover:bg-gray-700 focus:outline-none focus:bg-gray-700"><i
                                            class="fas fa-fw fa-add"></i> add</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            {{-- // show if type of invoice is not reimbursment --}}
            @if ($invoice->invoice_type == 'invoice')
                <div class="flex mt-3 justify-end p-3">
                    <div class="tax-detail w-1/2  text-sm">
                        <table class="w-full">
                            <tr>
                                <td>TOTAL AMOUNT STANDARD RATED (*)</td>
                                <td class="text-right">{{ number_format($invoice->amount()) }}</td>
                            </tr>
                            <tr>
                                <td>{{ $invoice->ppn }}% PPN AMOUNT</td>
                                <td class="text-right">
                                    {{ number_format(($invoice->amount() * $invoice->ppn) / 100) }}
                                </td>
                            </tr>
                            <tr>
                                <td>TOTAL AMOUNT INCLUDING PPN</td>
                                <td class="text-right border-t-2 border-gray-700 font-bold">
                                    {{ number_format($invoice->amountWithPPN()) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif
            {{-- //total currency --}}
            <div class="border p-3 rounded-md mx-2 mt-5">
                <div class="flex justify-between items-center">
                    <h3>CURRENCY IDR</h3>
                    <h3 class="text-right">
                        IDR
                        {{ number_format($invoice->amountWithPPN()) }}
                        <br>
                        <span id="totalEnglish" class="text-sm text-gray-500">-</span>
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white p-2 rounded-lg mt-3" id="invoice-description">
        <div class="description p-3 m-2">
            <p><i class="far fa-fw fa-file-alt"></i> Description</p>
            <table class="w-full mt-3">
                <tbody>
                    @foreach ($invoice->getDescription() as $item)
                        <tr class="descriptionItems">
                            <td class="whitespace-no-wrap py-1 w-60">
                                <div class="text-sm leading-5 text-gray-500">
                                    {{ $item->field }}
                                </div>
                            </td>
                            <td class="whitespace-no-wrap py-1 flex justify-between">
                                <div class="text-sm font-bold text-gray-900">
                                    {{ $item->description }}
                                </div>
                                <div class="description-action flex items-center">
                                    {{-- <i id="descriptionEdit"
                                        class="fas fa-fw fa-edit text-gray-500 hover:text-gray-700 cursor-pointer mr-1"></i> --}}
                                    <form action="{{ route('description.delete', $invoice) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="field" value="{{ $item->field }}">
                                        <button type="submit"><i
                                                class="fas fa-fw fa-times-circle text-gray-500 hover:text-gray-700 cursor-pointer"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <form action="{{ route('description.add', $invoice) }}" method="post">
                            @csrf
                            <td class="whitespace-no-wrap pt-4">
                                <input type="text" placeholder="Add field..." name="field" id="field"
                                    class="form-input rounded-sm w-full px-2 py-1 text-xs border appearance-none focus:border-transparent"
                                    value="{{ old('field') }}">
                                @error('field')
                                    <small class="text-sm text-red-500">{{ $message }}</small>
                                @enderror
                            </td>
                            <td class="whitespace-no-wrap pt-4">
                                <div class="flex w-full">
                                    <div class="w-11/12">
                                        <input type="text" placeholder="Add description detail..." name="description"
                                            id="description"
                                            class="form-input rounded-sm w-full px-2 py-1 text-xs border appearance-none focus:border-transparent"
                                            value="{{ old('description') }}">
                                        @error('description')
                                            <small class="text-sm text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="w-1/12">
                                        <button type="submit"
                                            class="px-2 py-1 rounded-sm text-xs bg-gray-800 text-gray-200 w-full ml-1 hover:bg-gray-700 focus:outline-none focus:bg-gray-700"><i
                                                class="fas fa-fw fa-add" id="iconDescription"></i></button>
                                    </div>
                                </div>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="bg-white p-2 rounded-lg mt-3" id="invoice-attachment">
        <div class="attachment p-3 m-2">
            <p><i class="fas fa-fw fa-paperclip"></i> Attachment</p>

            <input type="file" class="filepond my-3" name="attachmentFile" multiple>
            <div class="flex flex-wrap" id="attachment-file-list">
                @foreach ($invoice->getAttachment as $item)
                    <div class="w-fit border p-2 m-1">
                        <a href="{{ asset('attachment/' . $invoice->invoice_no . '/' . $item->attachment_name) }}"
                            target="_blank">
                            <i class="fa-fw fas fa-file text-red-700"></i>
                            <span class="text-sm">{{ $item->attachment_name }}</span>
                        </a>
                        <form action="{{ route('attachment.delete', $item) }}" method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-3 text-gray-400 hover:text-gray-600"><i
                                    class="fa-fw fas fa-times-circle"></i></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        FilePond.create(document.querySelector('.filepond'));
        FilePond.setOptions({
            allowRevert: false,
            server: {
                process: {
                    url: "{{ route('attachment.add', $invoice) }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    onload: function(response) {
                        response = JSON.parse(response)
                        if (response.status === 'failed') {
                            console.error('500 Internal Server Error!')
                        } else {
                            let listDom = document.getElementById('attachment-file-list')
                            let div = document.createElement('div')
                            div.classList.add('w-fit', 'border', 'p-2', 'm-1')
                            div.innerHTML = `
                            <a href="{{ asset('attachment/' . $invoice->invoice_no) }}/${response.data.attachment_name}" target="_blank">
                                <i class="fa-fw fas fa-file text-red-700"></i>
                                <span class="text-sm">${response.data.attachment_name}</span>
                            </a>
                            <a href="" class="ml-3 text-gray-400 hover:text-gray-600"><i
                                class="fa-fw fas fa-times-circle"></i></a>`
                            listDom.append(div)
                        }

                    }
                },
            },
        })

        document.querySelector('#totalEnglish').innerHTML = numberToEnglish(
            parseInt(
                "{{ $invoice->amountWithPPN() }}"
            )) + " rupiah only"

        let row = document.querySelectorAll('.invoiceItems')
        let el = document.createElement("tr")
        let open = false
        row.forEach(element => {
            element.children[5].children[0].addEventListener('click', (e) => {
                if (!open) {
                    let ID = element.children[5].children[0].dataset.id;
                    let price = element.children[3].children[0].textContent.trim().match(/[\S]+/g)
                    let el2 = ` <td colspan="6">
                        <form action="{{ route('item.update') }}" method="POST" class="flex items-center border-b border-gray-200">
                                <div class="px-6 py-4 ">
                                    <div class="text-sm leading-5 text-gray-500">
                                        #
                                    </div>
                                </div>
                                <div class="px-2 py-4 flex-none">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="${ID}">
                                    <input type="text" placeholder="Add new item..." name="item"
                                        class="form-input py-2 px-4 border rounded-md w-64 text-xs focus:outline-none"
                                        value="${element.children[1].children[0].textContent.trim()}">
                                    @error('item')
                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="px-2 py-4 flex-1">
                                    <select class="text-xs border border-gray-200 py-2 px-4 rounded-md w-48" name="service" id="service">
                                        @foreach ($services as $service)
                                            <option ${element.children[2].children[0].textContent.trim()=='{{ $service->name }}' ? 'selected' : '' }
                                                value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="px-2 py-4 flex-1">
                                    <div class="flex w-52 border border-gray-200 rounded-md overflow-hidden">
                                        <input type="number" placeholder="Price" name="price" id="priceEdit"
                                            class="form-input w-3/5 m-0 text-xs py-2 px-4 focus:outline-none"
                                            value="${parseInt(price[0].replace(/[,]/g, ''))}" onkeyup="getEditSum()">
                                            <span class="text-gray-400 bg-gray-200 px-1">&times;</span>
                                        <input type="number" placeholder="Qty" name="qty" id="qtyEdit"
                                            class="form-input w-2/5 m-0 text-xs py-2 px-4 focus:outline-none"
                                            value="${parseInt(price[1].match(/[0-9]+/g)[0])}" onkeyup="getEditSum()">
                                    </div>
                                    @error('price')
                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                    @enderror
                                    @error('qty')
                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="px-6 py-4 flex-1">
                                    <div class="text-xs text-gray-900 font-bold" id="amountEdit">
                                        ${element.children[4].children[0].textContent.trim()}
                                    </div>
                                </div>
                                <div class="flex-1 text-sm font-medium pl-4">
                                    <button type="submit"
                                        class="px-2 rounded-sm py-1 text-xs bg-gray-800 text-gray-200 hover:bg-gray-700 focus:outline-none focus:bg-gray-700"><i
                                            class="fas fa-fw fa-edit"></i> edit</button>
                                </div>
                                    </form></td>
                                `
                    el.innerHTML = el2
                    el.setAttribute('id', 'EditForm')
                    insertAfter(element, el)
                } else {
                    document.getElementById('EditForm').remove()
                }
                open = !open
            })
        });

        function getEditSum() {
            document.getElementById('amountEdit').textContent = (parseInt(document.getElementById('priceEdit').value) *
                parseInt(document.getElementById('qtyEdit').value) || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                ",")
        }

        function getAddSum() {
            document.getElementById('amountAdd').textContent = (parseInt(document.getElementById('priceAdd').value) *
                parseInt(document.getElementById('qtyAdd').value) || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                ",")
        }

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }

        // descriptionEdit
        let descriptionItems = document.querySelectorAll('.descriptionItems')
        descriptionItems.forEach(element => {
            element.children[1].children[1].children[0].addEventListener('click', () => {
                console.log('clicked');
            })
        })
    </script>
@endsection
