@extends('_layouts.master')

@section('body')
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of Remittances</h1>
            <a href="{{ route('remittance.create') }}" type="button"
                class="bg-red-700 text-white rounded-md text-sm py-1 px-4"><i class="fas fa-fw fa-add"></i> Create
                Remittance</a>
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
                        @foreach ($remittances as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ preg_replace('/-/', '/', $item->remittance_no) }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500 uppercase">
                                        NAFAARTS
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ number_format($item->amount()) }}
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>{{ $item->items()->count() }}
                                            {{ Str::plural('item', $item->items()->count()) }}</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Date : <strong>{{ $item->date }}</strong><br>
                                        Bank : <strong>{{ $item->bank->bank_detail }}</strong><br>
                                        Currency : <strong>{{ $item->currency }}</strong><br>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        {{ $item->user->name }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $item->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href="{{ route('remittance.detail', $item->remittance_no) }}"
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Remittance</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $remittances->links() }}
        </div>
    </div>
@endsection
