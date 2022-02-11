@extends('_layouts.master')

@section('body')
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of invoice</h1>
            <a href="/users/create" class="bg-red-700 text-white rounded-md text-sm py-1 px-4"><i
                    class="fas fa-fw fa-add"></i> Tambah
                Admin</a>
        </div>
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 mb-5">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Image</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Created At</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                            <img class="h-full w-full" src="{{ asset('img/users/' . $item->image) }}"
                                                alt="" />
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900 overflow-hidden truncate">
                                        {{ $item->name }}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $item->email }}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $item->level }}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="{{ route('users.edit', $item) }}"
                                        class="text-gray-600 hover:text-gray-900"><i class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('users.delete', $item) }}" method="POST"
                                        onsubmit="return confirmDelete(this)"
                                        class="delete-confirm text-gray-600 hover:text-gray-900 inline">
                                        @csrf
                                        @method('DELETE')
                                        <button><i class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- {{ $data->links() }} --}}
        </div>
    </div>

    <script>

    </script>
@endsection
