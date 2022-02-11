<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Login - Trans Continent</title>
    <link rel="icon" href="{{ asset('icon_white.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-100 px-6">
        <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
            <div class="mb-4 m-auto flex items-center">
                <img class="w-4/6" src="{{ asset('logo.png') }}" alt="Logo Trans Continent">
                <h3 class="w-2/6 text-gray-400 border-l-2 ml-3 text-center font-light">Accounting</h3>
            </div>
            <hr>
            <form class="mt-4" action="{{ route('login') }}" method="POST">
                @if (session('status'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg my-2" role="alert">
                        <p class="font-bold">Opps</p>
                        <small class="text-sm">{{ session('status') }}</small>
                    </div>
                @endif
                @csrf
                <label class="block">
                    <span class="text-gray-700 text-sm">Email</span>
                    <input type="email" name="email" placeholder="Masukan email"
                        class="form-input mt-1 block w-full py-2 px-4 border-gray-300 border rounded-md focus:border-green-600"
                        value="{{ old('email') }}">
                    @error('password')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </label>

                <label class="block mt-3">
                    <span class="text-gray-700 text-sm">Password</span>
                    <input type="password" name="password" placeholder="Masukan password"
                        class="form-input mt-1 block w-full py-2 px-4 border-gray-300 border rounded-md focus:border-green-600">
                    @error('password')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </label>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input name="remember" type="checkbox" class="form-checkbox" value="true">
                            <span class="mx-2 text-gray-600 text-sm">Remember me</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6">
                    <button
                        class="py-2 px-4 text-center bg-red-700 rounded-md w-full text-white text-sm hover:bg-red-600">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
