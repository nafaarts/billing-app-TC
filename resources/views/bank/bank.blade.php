@extends('_layouts.master')

@section('body')
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of Bank Account</h1>
            <a href="/bank-account/create" type="button" class="bg-red-700 text-white rounded-md text-sm py-1 px-4"><i
                    class="fas fa-fw fa-add"></i> Add new
                account</a>
        </div>
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 mb-5">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                #</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Account</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Bank Detail</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Swift Code</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->bank_name }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $item->bank_account_number }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900 overflow-hidden truncate">
                                        {{ $item->bank_detail }}
                                    </div>
                                    <div class="text-sm text-gray-500 whitespace-pre-line -mt-5">
                                        {{ $item->bank_address }}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $item->swift_code }} ({{ $item->bank_currency }})</td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">

                                    <a href="{{ route('bank.edit', $item) }}" class="text-gray-600 hover:text-gray-900"><i
                                            class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('bank.delete', $item) }}" method="POST" class="inline"
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
            {{ $data->links() }}
        </div>
    </div>
@endsection
