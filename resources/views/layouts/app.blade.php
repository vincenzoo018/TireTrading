<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8PLY TIRE AND SERVICES - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Topbar -->
            <div class="topbar">
                <div class="d-flex align-items-center">
                    <button class="mobile-toggle me-3" id="mobileToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                </div>

                <div class="user-info">
                    <div class="notifications me-3">
                        <button class="btn btn-light position-relative">
                            <i class="fas fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </button>
                    </div>
                    <div class="user-avatar">
                        <span>AD</span>
                    </div>
                    <div class="user-details">
                        <div class="user-name">Admin User</div>
                        <div class="user-role text-muted">Administrator</div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="app-footer">
                <p class="mb-0">© 2023 8PLY TIRE AND SERVICES. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileToggle = document.getElementById('mobileToggle');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });

            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-show');
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Responsive behavior
            function handleResize() {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                    sidebar.classList.remove('mobile-show');
                } else {
                    sidebar.classList.remove('mobile-show');
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize();

            // Active menu item highlighting
            const currentPage = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-menu a');

            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentPage) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
