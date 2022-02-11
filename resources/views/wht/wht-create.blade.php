@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Create WHT</h2>
        <hr class="my-3">
        <form action="{{ route('wht.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-2">
                <label class="text-xs mb-1">Client</label>
                <select name="client" id="client"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                    <option value="" disabled selected>Select Client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->company_name }} (
                            {{ $client->company_code }} )
                        </option>
                    @endforeach
                </select>
                <script>
                    document.getElementById('client').value = "{{ old('client') }}"
                </script>
                @error('client')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex mt-2">
                <div class="w-1/3 pr-1">
                    <label class="text-xs mb-1">WHT Date (optional)</label>
                    <input type="date" name="wht_date" id="wht_date" placeholder="Enter Date"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('wht_date') }}">
                    @error('wht_date')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/3 px-1">
                    <label class="text-xs mb-1">WHT Number (optional)</label>
                    <input type="text" name="wht_number" id="wht_number" placeholder="Enter WHT Number"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('wht_number') }}">
                    @error('wht_number')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/3 pl-1">
                    <label class="text-xs mb-1">Percentage (%)</label>
                    <input type="number" name="percentage" id="percentage" placeholder="Enter WHT Number"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('percentage') ?? '2' }}">
                    @error('percentage')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">WHT Document (optional)</label>
                <input type="file" name="wht_document" id="wht_document" placeholder="Enter Document"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('wht_document') }}">
                @error('wht_document')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Create</button>
            </div>
        </form>
    </div>

@endsection
