@extends('_layouts.master')

@section('body')
    <div class="flex flex-col" x-data='serviceForm()'>
        <div class="flex justify-between mb-5">
            <h1 class="font-bold">List of Services</h1>
        </div>
        <div class="bg-white p-3 rounded-lg shadow mb-2">
            <form x-bind:action="action" method="post" class="flex">
                <div class="flex-1" id="form">
                    @csrf
                    <input type="text" name="name" id="name" placeholder="Enter new service"
                        class="form-input w-full px-4 py-2 text-sm appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        x-bind:value="value" inputmode="none">
                </div>
                <div class="flex-shrink-0 w-42 ml-2">
                    <button type="submit" class="bg-red-700 text-white rounded-md text-sm h-full px-4">
                        <i class="fas fa-fw fa-add"></i> <span x-text="button"></span>
                    </button>
                </div>
            </form>
            @error('name')
                <small class="text-sm text-red-500">{{ $message }}</small>
            @enderror
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
                                Name</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Items</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Date Updated</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($services as $service)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $service->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm text-gray-900">
                                        {{ $service->items->count() }}
                                        {{ Str::plural('item', $service->items->count()) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        {{ $service->updated_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">

                                    <button x-on:click="setEdit('{{ $service->id }}', '{{ $service->name }}')"
                                        class="text-gray-600 hover:text-gray-900"><i class="fas fa-fw fa-edit"></i></button>

                                    <form action="{{ route('service.destroy', $service) }}" method="POST"
                                        class="inline" onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button {{ $service->items->count() > 0 ? 'disabled' : '' }}
                                            class="text-gray-600 hover:text-gray-900"><i
                                                class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $services->links() }}
        </div>
    </div>

    <script>
        function serviceForm() {
            return {
                method: 'add',
                button: 'Add Service',
                value: "{{ old('name') }}",
                action: "{{ route('service.add') }}",
                setEdit(id, value) {
                    this.method = 'edit'
                    this.button = 'Edit Service'
                    this.value = value
                    this.action = "{{ route('service.update') }}"
                    let form = document.createElement('input')
                    form.setAttribute('type', 'hidden')
                    form.setAttribute('name', 'id')
                    form.value = id
                    document.getElementById('form').append(form)
                },
                setAdd() {
                    this.method = 'add'
                    this.button = 'Add Service'
                    this.value = "{{ old('name') }}"
                    this.action = "{{ route('service.add') }}"
                }
            }
        }
    </script>
@endsection
