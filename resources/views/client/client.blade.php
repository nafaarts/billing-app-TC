@extends('_layouts.master')

@section('body')
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of Client</h1>
            <a href="{{ route('client.create') }}" type="button"
                class="bg-red-700 text-white rounded-md text-sm py-1 px-4"><i class="fas fa-fw fa-add"></i> Add new
                client</a>
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
                                Detail</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Code</th>


                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Departement</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Address</th>

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
                                        {{ $item->company_name }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $item->company_npwp }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->company_code }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ $item->company_departement }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900 whitespace-pre-line -mt-5">
                                        {{ $item->company_address }}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">

                                    <a href="{{ route('client.edit', $item) }}"
                                        class="text-gray-600 hover:text-gray-900"><i class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('client.delete', $item) }}" method="POST"
                                        class="inline" onsubmit="return confirmDelete(this)">
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
