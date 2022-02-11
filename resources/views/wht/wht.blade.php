@extends('_layouts.master')

@section('body')
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of WHT's</h1>
            <a href="{{ route('wht.create') }}" class="bg-red-700 text-white rounded-md text-sm py-1 px-4"><i
                    class="fas fa-fw fa-add"></i> Create
                WHT</a>
        </div>
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 mb-5">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Reference Code</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Client</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Added by</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($whts as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ preg_replace('/-/', '/', $item->reference_code) }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500 uppercase">
                                        NAFAARTS
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->client->company_name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        @if ($item->status())
                                            <span class="py-2 px-4 bg-green-500 rounded-md text-white">Confirmed</span>
                                        @else
                                            <span class="py-2 px-4 bg-red-500 rounded-md text-white">Not Confirmed</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $item->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href="/"
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        WHT</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $whts->links() }}
        </div>
    </div>
@endsection
