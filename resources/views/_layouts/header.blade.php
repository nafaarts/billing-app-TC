<header class="flex justify-center md:justify-between items-center py-3 px-4 bg-white shadow-lg z-10">
    <div class="flex text-gray-400">
        <button id="sidebar-btn" class="text-2xl mr-3">
            <i class="fas fa-fw" id="sidebar-icon"></i>
        </button>
        <div class="form-cari relative w-40">
            <label for="cari">
                <i class="fas fa-fw fa-search absolute top-2.5 left-3"></i>
            </label>
            <input type="text" id="cari" class="border-2 px-10 py-1 rounded-lg" placeholder="Search invoice...">
        </div>
    </div>
    <div class="md:flex items-center hidden">
        <div class="relative">
            <div id="profile-navbar" class="flex items-center cursor-pointer">
                <h3 class="text-sm text-gray-500">{{ auth()->user()->name ?? 'No Auth Data' }}</h3>
                <button class="ml-4 relative block h-8 w-8 border rounded-full overflow-hidden focus:outline-none">
                    <img class="h-full w-full object-cover"
                        src="{{ asset('img/users/' . (auth()->user()->image ?? 'sample.png')) }}">
                </button>
            </div>
            <div id="profile-menu"
                class="absolute hidden right-0 mt-7 bg-white rounded-md overflow-hidden shadow-xl z-10 text-center ring-4 ring-gray-50">
                <div class="mx-10">
                    <div class="image-circle h-20 w-20 rounded-full overflow-hidden m-auto my-3">
                        <img class="h-full w-full object-cover"
                            src="{{ asset('img/users/' . (auth()->user()->image ?? 'sample.png')) }}">
                    </div>
                    <h3 class="text-sm mt-4 text-gray-900">{{ auth()->user()->name ?? 'No Auth Data' }}</h3>
                    <small class="text-xs text-gray-500">{{ auth()->user()->email }}</small>
                    <br>
                    <small class="text-gray-500">{{ auth()->user()->level }}</small>
                </div>
                <hr class="mt-4">
                <div class="flex">
                    <a href="{{ route('profile') }}"
                        class="block text-sm text-center text-gray-700 hover:bg-gray-600 hover:text-white w-1/2 py-3"><i
                            class="fas fa-fw fa-user-cog"></i> Profile</a>
                    <form action="{{ route('logout') }}" method="post" class="w-1/2">
                        @csrf
                        <button class="block text-sm text-gray-700 hover:bg-red-800 hover:text-white py-3 w-full">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="profile-wrap"
    class="fixed hidden inset-0 bg-gradient-to-tr from-transparent to-gray-200 bg-opacity-50 h-full w-full"></div>


<script>
    let profileNavbar = document.querySelector('#profile-navbar')
    let profileMenu = document.querySelector('#profile-menu')
    let profileWrap = document.querySelector("#profile-wrap")

    profileNavbar.addEventListener('click', () => {
        profileMenu.classList.toggle('hidden')
        profileWrap.classList.toggle('hidden')
    })

    profileWrap.addEventListener('click', () => {
        profileMenu.classList.add('hidden')
        profileWrap.classList.add('hidden')
    })

    const setActiveSidebar = (status) => {
        document.getElementById('sidebar-icon').classList.remove(status ? 'fa-times' : 'fa-bars')
        document.getElementById('sidebar-icon').classList.add(status ? 'fa-bars' : 'fa-times')
        if (status == false) {
            document.getElementById('sidebar').classList.remove('hide')
        } else {
            document.getElementById('sidebar').classList.add('hide')
        }
        document.getElementById('main-logo').setAttribute("src", status == false ? "{{ asset('logo.png') }}" :
            "{{ asset('logo-small.png') }}")
    }

    let showSidebar = false;
    if (localStorage.getItem("showSidebar") == null) {
        localStorage.setItem("showSidebar", showSidebar);
    } else {
        showSidebar = localStorage.getItem("showSidebar") === "true"
    }

    setActiveSidebar(showSidebar)

    document.getElementById('sidebar-btn').addEventListener('click', () => {
        showSidebar = !showSidebar
        setActiveSidebar(showSidebar)
        localStorage.setItem("showSidebar", showSidebar);
    })
</script>
