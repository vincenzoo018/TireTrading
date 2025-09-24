<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-text">8PLY TIRE & SERVICES</div>
        <button class="toggle-btn" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.product') }}">
                <i class="fas fa-box"></i>
                <span class="menu-text">Product</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.inventory') }}">
                <i class="fas fa-warehouse"></i>
                <span class="menu-text">Inventory</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.customers') }}">
                <i class="fas fa-users"></i>
                <span class="menu-text">Customers</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.suppliers') }}">
                <i class="fas fa-truck"></i>
                <span class="menu-text">Suppliers</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders') }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="menu-text">Orders</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.sales') }}">
                <i class="fas fa-chart-line"></i>
                <span class="menu-text">Sales</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.transactions') }}">
                <i class="fas fa-exchange-alt"></i>
                <span class="menu-text">Transactions</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.employee') }}">
                <i class="fas fa-user-tie"></i>
                <span class="menu-text">Employee</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.stocks') }}">
                <i class="fas fa-boxes"></i>
                <span class="menu-text">Stocks</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.bookings') }}">
                <i class="fas fa-calendar-check"></i>
                <span class="menu-text">Bookings</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}">
                <i class="fas fa-sign-out-alt"></i>
                <span class="menu-text">Logout</span>
            </a>
        </li>
    </ul>
</aside>
