<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title ?? 'Billing App - Trans Continent' }}</title>
    <link rel="icon" href="{{ asset('icon_white.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body onload="window.print()">
    <div class="flex justify-between">
        <div class="w-fit border border-black rounded-3xl m-2">
            <div class="client mx-5 flex items-center h-full">
                <div class="client-content">
                    <h3 class="font-bold">{{ $invoice->client->company_name }}</h3>
                    <hr class="my-2">
                    <p class="text-sm text-gray-500 whitespace-pre-line -mt-5">
                        {{ $invoice->client->company_address }}
                    </p>
                    <h5 class="font-bold mt-2">Attn : {{ $invoice->client->company_departement }}</h5>
                </div>
            </div>
        </div>
        <div class="invoice-detail m-4 pr-4 text-xs flex flex-col justify-items-end">
            <h3 class="text-lg text-right mb-4">INVOICE NO : <strong>{{ $invoice->invoice_no }}</strong></h3>
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
            <p class="font-bold underline mt-4">"Please Pay in Full Amount"</p>
        </div>
    </div>
    <div class="py-2">
        <div class="items">
            <table class="min-w-full">
                <thead>
                    <tr class="">
                        <th
                            class="px-3 py-1 border-t border-b border-black text-left text-xs font-medium text-black uppercase">
                            Detail of charges</th>

                        <th
                            class="px-3 py-1 border-t border-b border-black text-left text-xs font-medium text-black uppercase">
                            Price</th>

                        <th
                            class="px-3 py-1 border-t border-b border-black text-left text-xs font-medium text-black uppercase">
                            Qty</th>

                        <th
                            class="px-3 py-1 border-t border-b border-black  text-left text-xs font-medium text-black uppercase">
                            Amount</th>

                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($invoice->items as $item)
                        <tr class="invoiceItems">
                            <td class="px-3 py-1 text-xs flex max-w-2xl">
                                <span class="font-bold">{{ $loop->iteration }}</span>
                                <div class="text-gray-900 ml-3">
                                    {{ $item->item_detail }}
                                </div>
                            </td>

                            <td class="px-3 py-1">
                                <div class="text-xs text-gray-900">
                                    {{ number_format($item->price) }}
                                </div>
                            </td>

                            <td class="px-3 py-1">
                                <div class="text-xs text-gray-900">
                                    {{ $item->quantity }}
                                </div>
                            </td>
                            <td class="px-3 py-1">
                                <div class="text-xs text-gray-900">
                                    {{ number_format($item->price * $item->quantity) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="description px-3 mt-1">
        <table class="w-full">
            <tbody>
                @foreach ($invoice->getDescription() as $item)
                    <tr class="descriptionItems">
                        <td class="w-60">
                            <div class="text-xs leading-5 text-gray-500">
                                {{ $item->field }}
                            </div>
                        </td>
                        <td>
                            <div class="text-xs font-bold text-gray-900">
                                {{ $item->description }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($invoice->invoice_type == 'invoice')
        <div class="p-3">
            <div class="tax-detail w-2/3 text-xs">
                <table class="w-full">
                    <tr>
                        <td>TOTAL AMOUNT ZERO RATED</td>
                        <td class="text-right">{{ number_format(0) }}</td>
                    </tr>
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
    <div class="border-t border-b border-black p-3 mt-1">
        <div class="flex justify-between items-center">
            <h3>CURRENCY IDR</h3>
            <h3 class="text-right">
                IDR
                {{ number_format($invoice->amountWithPPN()) }}
                <br>
            </h3>
        </div>
        <span id="totalEnglish" class="text-sm text-gray-500">-</span>
    </div>

    <div class="flex mt-1 justify-between">
        <div class="w-fit border border-black rounded-3xl m-2">
            <div class="bank m-4 flex items-center">
                <div class="bank-content text-xs">
                    <h6>Kindly Remit to:</h6>
                    <h3 class="font-bold">{{ $invoice->bank->bank_name }}</h3>
                    <h3 class="font-bold">{{ $invoice->bank->bank_detail }}</h3>
                    <p class="font-bold whitespace-pre-line -mt-4">
                        {{ $invoice->bank->bank_address }}<br>
                    </p>
                    <h3 class="font-bold -mt-4">(Swift Code: {{ $invoice->bank->swift_code }})</h3>
                    <h5 class="font-bold mt-2">Account ({{ $invoice->bank->bank_currency }}) No. :
                        {{ $invoice->bank->bank_account_number }}</h5>
                </div>
            </div>
        </div>
        <div class="signature m-4 pr-4 text-sm flex flex-col">
            <h3>PT TRANS CONTINENT</h3>
            <div class="box h-full w-48 border-b border-black"></div>
            <small>Authorized Signature</small>
        </div>
    </div>

    <script>
        document.querySelector('#totalEnglish').innerHTML = numberToEnglish(
            parseInt(
                "{{ $invoice->amountWithPPN() }}"
            )) + " rupiah only"
    </script>
</body>

</html>
