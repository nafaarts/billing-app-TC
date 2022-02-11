<div id="sidebar"
    class="fixed z-30 inset-y-0 left-0 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 -translate-x-full lg:static lg:inset-0 shadow-lg flex flex-col justify-between hide">
    <div>
        <div class="flex items-center justify-center py-4">
            <img src="{{ asset('logo.png') }}" alt=" Logo Transcontinent" id="main-logo">
        </div>
        <hr>
        <nav>
            <a class=" menu-link flex items-center mt-4 py-2 px-6 text-gray-600  hover:text-gray-800" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span class="mx-3">Dashboard</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/invoice">
                <i class="fas fa-fw fa-file-invoice"></i>
                <span class="mx-3">Invoice</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/remittance">
                <i class="fas fa-fw fa-file-invoice-dollar"></i>
                <span class="mx-3">Remittance</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/wht">
                <i class="fas fa-fw fa-thumbtack"></i>
                <span class="mx-3">WHT</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/client">
                <i class="fas fa-fw fa-briefcase"></i>
                <span class="mx-3">Client</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800"
                href="/bank-account">
                <i class="fas fa-fw fa-money-check-alt"></i>
                <span class="mx-3">Bank Account</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/report">
                <i class="fas fa-fw fa-file-excel"></i>
                <span class="mx-3">Report</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/users">
                <i class="fas fa-fw fa-user-tie"></i>
                <span class="mx-3">Users</span>
            </a>

            <a class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/services">
                <i class="fas fa-fw fa-border-all"></i>
                <span class="mx-3">Services</span>
            </a>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="menu-link flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800 w-full"><i
                        class="fas fa-fw fa-sign-out-alt"></i>
                    <span class="mx-3">Logout</span></button>
            </form>
        </nav>
    </div>
    <footer class="text-center mt-4 p-8 text-gray-400 border-t">
        <small>Developed by &copy; <strong><a href="https://n.nafaarts.com" target="_blank">
                    Intern</a></strong> 2021</small>
    </footer>
</div>

<style>
    #main-logo {
        width: 210px;
        padding: 20px
    }

    #sidebar {
        transition: 1s;
    }

    .hide .menu-link span {
        display: none;
    }

    .hide .menu-link i {
        font-size: 20px
    }

    .hide footer {
        display: none;
    }

    .hide #main-logo {
        width: 30px;
        padding: 0;
    }

    .hide hr {
        display: none
    }

</style>
