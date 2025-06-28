<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Human Resource</title>
  <script src="https://cdn.tailwindcss.com"></script>
   <title>@yield('page-title', 'Default Title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/bar.css') }}">
</head>
<body>


<header class="top-navbar">
    <div class="top-navbar-left">
        <div >
            <span class="font-semibold text-lg">Hallo Admin</span>
        </div>
    </div>
        <div class="user-info">
            <button class="user-btn">
                <div class="user-avatar">T</div>
                <i class="bi bi-chevron-down"></i> 
            </button>
        </div>
    </div>
</header>

<div class="section">
    
    <!-- Sidebar -->
    <aside class="sidebar" aria-label="Sidebar">
        <nav class="sidebar-nav">
            <a href="#" class="sidebar-item active" aria-current="page" title="Dashboard">
                <i class="bi bi-house-door"></i> 
                <span class="sidebar-item-name">Dashboard</span>
            </a>
            <a href="#" class="sidebar-item" title="Users">
                <i class="bi bi-person"></i> 
                <span class="sidebar-item-name">Data karyawan</span>
            </a>
            <a href="#" class="sidebar-item" title="Branches">
                <i class="bi bi-calendar-check"></i> 
                <span class="sidebar-item-name">cuti izin</span>
            </a>
            <a href="#" class="sidebar-item" title="Reports">
                <i class="bi bi bi-cash-stack"></i> 
                <span class="sidebar-item-name">slip gaji</span>
            </a>
            <a href="#" class="sidebar-item" title="Settings">
                <i class="bi bi-file-earmark-bar-graph"></i> 
                <span class="sidebar-item-name"></span>
            </a>
            <a href="#" class="sidebar-item" title="Help">
                <i class="bi bi bi-clock-history"></i> 
                <span class="sidebar-item-name">History login</span>
            </a>
            <a href="#" class="sidebar-item" title="Logout">
                <i class="bi bi-box-arrow-right"></i> 
                <span class="sidebar-item-name">Logout</span>
            </a>
            <button aria-label="Collapse sidebar" class="sidebar-toggle">
                <i class="bi bi-arrow-right-circle"></i> 
            </button>
        </nav>
    </aside>

    <div class="main-content-wrapper" style="display: flex; flex-direction: column; align-items: flex-start;"> 
         
        <header style="align-self: flex-start; margin-left: 30px; margin-top: 30px;">
         @yield('page-title')
    </header>
    
    
    <main class="main-content-body">
        
        @yield('content')
    </main>
    </section2>
</div>

<script>
    const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.querySelector('.sidebar-toggle');
const sidebarItems = document.querySelectorAll('.sidebar-item');

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('expanded');
    sidebarItems.forEach(item => {
        const itemName = item.querySelector('.sidebar-item-name');
        if (itemName) {
            itemName.classList.toggle('hidden');
        }
    });
});

</script>

</body>
</html>
