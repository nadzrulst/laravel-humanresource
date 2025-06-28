<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                nodepay
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-house"></i></span>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item has-submenu">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-calendar-week"></i></span>
                            Cuti
                            <i class="bi bi-caret-down-fill submenu-toggle-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('employees.index') }}">Employee</a></li>
                            <li><a href="{{ route('positions.index') }}">Positions</a></li>
                            <li><a href="{{ route('departments.index') }}">departments</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-calendar-check"></i></span>
                            Presensi
                        </a>
                    </li>

                    <!-- Dropdown Menu Cuti -->
                    <li class="nav-item has-submenu">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-calendar-week"></i></span>
                            Cuti
                            <i class="bi bi-caret-down-fill submenu-toggle-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('leave_requests.index') }}">Leave Requests</a></li>
                            <li><a href="{{ route('leave_approvals.index') }}">Leave Approvals</a></li>
                            <li><a href="{{ route('leave_types.index') }}">Leave Types</a></li>
                            <li><a href="{{ route('leave_balances.index') }}">Leave Balances</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-receipt"></i></span>
                            Manajemen Gaji
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-graph-up"></i></span>
                            Laporan HR
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('activity_logs.index') }}" class="nav-link">
                            <span class="nav-icon"><i class="bi bi-clock"></i></span>
                            History Aktivitas
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class='search-bar'>
                    <form action="/search" method="GET">
                        <input type="text" name="query" class="search-box" placeholder="Masukkan kata kunci..." required>
                    </form>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">N</div>
                    <span class="user-name">Nadzulapay</span>
                    <span class="dropdown-icon">▼</span>
                </div>
            </header>

            @yield('page-title')

            <!-- Content -->
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Script -->
    <script>
        const currentUrl = window.location.href;

        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
            }

            link.addEventListener('click', function () {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Toggle dropdown submenu
        document.querySelectorAll('.has-submenu > .nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = this.closest('.has-submenu');
                parent.classList.toggle('open');
            });
        });

        // User menu demo
        document.querySelector('.user-menu').addEventListener('click', function () {
            alert('User menu clicked! (Demo)');
        });
    </script>
</body>
</html>