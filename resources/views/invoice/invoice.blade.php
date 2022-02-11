@extends('_layouts.master')

@section('body')
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of invoice</h1>
            <a href="{{ route('invoice.create') }}" type="button"
                class="bg-red-700 text-white rounded-md text-sm py-1 px-4"><i class="fas fa-fw fa-add"></i> Create Invoice</a>
        </div>
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 mb-5">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                invoice</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Detail</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Added by</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($invoices as $invoice)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $invoice->invoice_no }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500 uppercase">
                                        {{ $invoice->client->company_name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $invoice->currency == 'Rupiah' ? 'Rp.' : '$' }}
                                        {{ number_format($invoice->amount()) }}
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>{{ $invoice->items->count() }}
                                            {{ Str::plural('item', $invoice->items->count()) }}</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Job Ref : <strong>{{ $invoice->job_reference }}</strong><br>
                                        Terms : <strong>{{ $invoice->terms }}</strong><br>
                                        Date : <strong>{{ $invoice->date }}</strong><br>
                                        Due Date : <strong>{{ $invoice->due_date }}</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        {{ $invoice->userBy->name }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $invoice->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href="{{ route('invoice.detail', $invoice->invoice_no) }}"
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Invoice</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $invoices->links() }}
        </div>
    </div>
@endsection
