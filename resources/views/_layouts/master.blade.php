<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title ?? 'Billing App - Trans Continent' }}</title>
    <link rel="icon" href="{{ asset('icon_white.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/filepond.min.css') }}" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
    <script src="{{ asset('js/filepond.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.1/alpine.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-200 font-roboto">
        @include('_layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('_layouts.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-4 py-4">
                    @if (session('status'))
                        <script>
                            Swal.fire({
                                title: 'Good job!',
                                text: "{{ session('status') }}",
                                icon: 'success',
                                confirmButtonColor: '#047857',
                            })
                        </script>
                    @endif
                    @yield('body')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
