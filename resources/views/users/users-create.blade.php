@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Add new user</h2>
        <hr class="my-3">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex">
                <div class="md:w-1/3 w-full">
                    <div class="mt-2 h-full flex items-center justify-center">
                        <div class="flex flex-col items-center">
                            <label
                                class="input-file w-48 h-48 rounded-full focus:border-green-600 border border-gray-400 inline-block px-4 py-2 cursor-pointer text-gray-400">
                                <input type="file" name="gambar" class="hidden">

                            </label>
                            <small class="text-2sm my-2 text-gray-500">
                                <i class="fas fa-image fa-fw"></i>
                                <span id="file-placeholder" class="ml-2">Ketuk gambar untuk ganti</span>
                            </small>
                            @error('gambar')
                                <small class="text-sm text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <style>
                            .input-file {
                                background-image: url("{{ asset('img/users/sample.png') }}");
                                background-position: center center;
                                background-size: cover;
                            }

                        </style>
                    </div>
                </div>
                <div class="md:w-2/3">
                    <div class="mt-2">
                        <label class="text-xs mb-1">Full Name</label>
                        <input type="text" placeholder="Enter user's name" name="name"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label class="text-xs mb-1">Email Address</label>
                        <input type="email" placeholder="Enter email address" name="email"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label class="text-xs mb-1">Level Account</label>
                        <select name="level"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                            <option value="SU">Super User</option>
                            <option value="BL">Billing</option>
                            <option value="AR">Account Receivable</option>
                        </select>

                    </div>
                    <div class="flex mt-2">
                        <div class="w-1/2 mr-1">
                            <label class="text-xs mb-1">Password</label>
                            <input type="password" placeholder="Enter password" name="password"
                                class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                                value="{{ old('password') }}">
                            @error('password')
                                <small class="text-sm text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-1/2 ml-1">
                            <label class="text-xs mb-1">Confirm Password</label>
                            <input type="password" placeholder="Confirm password" name="password_confirmation"
                                class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let input = document.querySelector('.input-file')
        input.addEventListener("change", () => {
            path = input.childNodes[1].value.split(/(\\|\/)/g).pop()
            input.style.backgroundImage = `url('${URL.createObjectURL(input.childNodes[1].files[0])}')`
            document.querySelector('#file-placeholder').innerHTML =
                `${path} / ${humanFileSize(input.childNodes[1].files[0].size, 2)}`
        })
    </script>

@endsection
