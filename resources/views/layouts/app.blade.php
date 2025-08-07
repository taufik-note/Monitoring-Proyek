<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Proyek</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
          font-family: 'Arial', sans-serif;
          padding-bottom: 60px; /* space for fixed footer */
        }
        .navbar-nav .nav-link.active {
            font-weight: bold;
            color: #0d6efd !important;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #f8f9fa;
            border-top: 1px solid #e7e7e7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #6c757d;
            z-index: 1030;
        }
        main.container {
            padding-top: 20px;
            padding-bottom: 20px;
            min-height: calc(100vh - 120px); /* navbar + footer height */
        }
        .flash-message {
            position: fixed;
            top: 70px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold ms-3" href="{{ url('/') }}">
                    Monitoring Proyek
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('proyeks.*') ? 'active' : '' }}" href="{{ route('proyeks.index') }}">Proyek</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tugas.*') ? 'active' : '' }}" href="{{ route('tugas.index') }}">Tugas</a>
                        </li>
                    @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flash-message" style="position: fixed; top: 56px; right: 20px; z-index: 1050; min-width: 300px;">
            @foreach (['success', 'error', 'warning', 'info'] as $msg)
                @if(session()->has($msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                        {{ session()->get($msg) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach
        </div>

        <main class="container" style="padding-top: 80px;">
            @yield('content')
        </main>
    </div>

    <footer>
        &copy; {{ date('Y') }} Monitoring Proyek. Ambatoring.
    </footer>

    <!-- Menyertakan Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Menyertakan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
