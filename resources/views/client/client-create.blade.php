@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Add Client</h2>
        <hr class="my-3">
        <form action="{{ route('client.store') }}" method="POST">
            @csrf
            <div class="mt-2">
                <label class="text-xs mb-1">Company Name</label>
                <input type="text" placeholder="Enter company name" name="company_name" id="company_name"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('company_name') }}">
                @error('company_name')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex mt-2">
                <div class="w-1/2 pr-1">
                    <label class="text-xs mb-1">Company Code</label>
                    <input type="text" placeholder="Enter company Code" name="company_code" id="company_code"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('company_code') }}">
                    @error('company_code')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-1/2 pl-1">
                    <label class="text-xs mb-1">Company NPWP</label>
                    <input type="text" placeholder="Enter company NPWP" name="company_npwp"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ old('company_npwp') }}">
                    @error('company_npwp')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Departement</label>
                <input type="text" placeholder="Enter company departement" name="company_departement"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('company_departement') }}">
                @error('company_departement')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Company Address</label>
                <textarea placeholder="Enter company address" name="company_address" rows="4" cols="50"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">{{ old('company_address') }}</textarea>
                @error('company_address')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let input = document.getElementById("company_name")
        input.addEventListener("keyup", suggested);

        function suggested(e) {
            let data = null
            if (input.value) data = input.value.match(/^[PT|CV]+|\b[A-Z]/gi).join('').toUpperCase()
            document.getElementById("company_code").value = data
        }
    </script>

@endsection
