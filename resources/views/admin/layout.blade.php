<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Add any additional styling here */
            body {
                display: flex;
                min-height: 100vh;
            }
            .sidebar {
                width: 250px;
                background-color: #343a40;
                color: white;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .sidebar a {
                color: white;
            }
            .navbar {
                margin-left: auto; /* Push navbar to the right */
            }
            .content {
                flex-grow: 1;
            }
        </style>
    @endif

    <link rel="stylesheet" href="/vendor/laravel-filemanager/css/lfm.css">
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="sidebar">
    <div class="p-3"  style="background-color: #54B4D3">
        <h2>Admin Panel</h2>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}  <!-- Display logged-in user's name -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin') ? 'disabled' : '' }}" href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.filesystem') ? 'disabled' : '' }}" href="{{ route('admin.filesystem') }}">Filesystem</a>
        </li>
    </ul>
</div>

<div class="content">

    <div class="container mt-4">
        @yield('content')
    </div>
</div>

</body>
</html>
