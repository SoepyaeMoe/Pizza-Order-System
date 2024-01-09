<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="@yield('home_active') has-sub">
                    <a class="js-arrow" href="{{ route('admin.home') }}">
                        <i class="fas fa-tachometer-alt"></i>Home Page
                    </a>
                </li>
                <li class="@yield('admin_active')">
                    <a class="js-arrow" href="{{ route('admin.admin.list') }}">
                        <i class="fas fa-users"></i>Admin List</a>
                </li>
                <li class="@yield('customer_active')">
                    <a href="{{ route('admin.customer.list') }}">
                        <i class="fas fa-chart-bar"></i>Customers</a>
                </li>
                <li class="@yield('category_active')">
                    <a class="js-arrow" href="{{ route('admin.category.list') }}">
                        <i class="fas fa-chart-bar"></i>Category</a>
                </li>
                <li class="@yield('product_active')">
                    <a class="js-arrow" href="{{ route('admin.product.list') }}">
                        <i class="fas fa-clipboard"></i>Product</a>
                </li>
                <li class="@yield('order_active')">
                    <a class="js-arrow" href="{{ route('admin.order.list') }}">
                        <i class="fas fa-list"></i>Orders</a>
                </li>
                <li class="@yield('contact_active')">
                    <a class="js-arrow" href="{{ route('admin.contact') }}">
                        <i class="fas fa-address-book"></i></i>Contacts</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
