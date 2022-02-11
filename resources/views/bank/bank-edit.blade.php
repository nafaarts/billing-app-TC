@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Edit Bank Account</h2>
        <hr class="my-3">
        <form action="{{ route('bank.update', $data) }}" method="POST">
            @csrf
            <div class=" mt-2">
                <label class="text-xs mb-1">Account Name</label>
                <input type="text" placeholder="Enter account name" name="account_name"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $data->bank_name }}">
                @error('account_name')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Bank Detail</label>
                <input type="text" placeholder="Enter bank detail" name="bank_detail"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $data->bank_detail }}">
                @error('bank_detail')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Account Number</label>
                <input type="text" placeholder="Enter account number" name="account_number"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $data->bank_account_number }}">
                @error('account_number')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex mt-2">
                <div class="w-1/3 mr-1">
                    <label class="text-xs mb-1">Currency</label>
                    <select name="currency" id="currency"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                        <option value="Rupiah">(Rp) Rupiah</option>
                        <option value="Dollar">($) Dollar</option>
                    </select>
                    <script>
                        document.querySelector('#currency').value = "{{ $data->bank_currency }}"
                    </script>
                </div>
                <div class="w-2/3 ml-1">
                    <label class="text-xs mb-1">Swift Code</label>
                    <input type="text" placeholder="Enter swift code" name="swift_code"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                        value="{{ $data->swift_code }}">
                    @error('swift_code')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Address</label>
                <textarea placeholder="Enter bank address" name="bank_address" rows="4" cols="50"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">{{ $data->bank_address }}</textarea>
                @error('bank_address')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Submit</button>
            </div>
        </form>
    </div>

@endsection
