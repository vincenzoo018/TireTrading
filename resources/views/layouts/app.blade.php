<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '8PLY TIRE AND SERVICES' }}</title>

    <!-- Common CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Conditional CSS: admin or customer --}}
    @if(isset($layout) && $layout === 'admin')
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    @endif

    @yield('styles')
</head>
<body>
    @if(isset($layout) && $layout === 'admin')
        {{-- ========== ADMIN LAYOUT ========== --}}
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
    @else
        {{-- ========== CUSTOMER LAYOUT ========== --}}
        <!-- Navigation -->
        @include('layouts.navbar')

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    @endif

    <!-- Common JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @if(isset($layout) && $layout === 'admin')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                const sidebarToggle = document.getElementById('sidebarToggle');
                const mobileToggle = document.getElementById('mobileToggle');

                if (sidebarToggle) {
                    sidebarToggle.addEventListener('click', function() {
                        sidebar.classList.toggle('collapsed');
                        mainContent.classList.toggle('expanded');
                    });
                }

                if (mobileToggle) {
                    mobileToggle.addEventListener('click', function() {
                        sidebar.classList.toggle('mobile-show');
                    });
                }

                // tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(el => new bootstrap.Tooltip(el));

                // responsive
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

                // highlight active menu
                const currentPage = window.location.pathname;
                const menuItems = document.querySelectorAll('.sidebar-menu a');
                menuItems.forEach(item => {
                    if (item.getAttribute('href') === currentPage) {
                        item.classList.add('active');
                    }
                });
            });
        </script>
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                updateCartCount();
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
            });

            function updateCartCount() {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                const cartCount = document.getElementById('cartCount');
                if (cartCount) {
                    cartCount.textContent = cart.length;
                }
            }

            function addToCart(productId, productName, price) {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                cart.push({ id: productId, name: productName, price: price, quantity: 1 });
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                alert(`${productName} added to cart!`);
            }
        </script>
    @endif

    @yield('scripts')
</body>
</html>
