@extends('_layouts.master')

@section('body')
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">My Profile</h2>
        <hr class="my-3">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return confirmChange(this)">
            @csrf
            @method('PATCH')
            <div class="flex md:flex-row flex-col">
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
                        </div>
                        <style>
                            .input-file {
                                background-image: url("{{ asset('img/users/' . $profile->image) }}");
                                background-position: center center;
                                background-size: cover;
                            }

                        </style>
                        @error('gambar')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="md:w-2/3 w-full">
                    <div class="mt-2">
                        <label class="text-xs mb-1">Nama Lengkap</label>
                        <input type="text" placeholder="Masukan nama lengkap" name="name"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                            value="{{ $profile->name }}">
                        @error('name')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label class="text-xs mb-1">Alamat Email</label>
                        <input type="email" placeholder="Masukan alamat email" name="email"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                            value="{{ $profile->email }}">
                        @error('email')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <h3 class="font-bold">Password</h3>
                        <small class="text-2sm text-gray-500">*kosongkan jika tidak ingin <strong>mengganti
                                password</strong></small>
                        <div class="flex mt-2">
                            <div class="w-1/2 pr-1">
                                <label class="text-xs mb-1">Change Password</label>
                                <input type="password" placeholder="Masukan password" name="password"
                                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                                @error('password')
                                    <small class="text-sm text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-1/2 pl-1">
                                <label class="text-xs mb-1">Confirm Password</label>
                                <input type="password" placeholder="Konfirmasi password" name="password_confirmation"
                                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex md:flex-row flex-col justify-between mt-6 items-end">
                <small class="text-gray-500"><i class="fas fa-fw fa-info-circle"></i> Created at
                    <strong>{{ $profile->created_at->diffForHumans() }}</strong> and Last updated at
                    <strong>{{ $profile->updated_at->diffForHumans() }}</strong></small>
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Save</button>
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

        function confirmChange(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Kamu harus login ulang setelah melakukan perubahan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#047857',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.submit()
                }
            })
            return false
        }
    </script>
@endsection
