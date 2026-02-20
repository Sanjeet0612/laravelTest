<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="#" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a  href="#">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                
            </li>
      
           

            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="icon-park-outline:box" class="menu-icon"></iconify-icon>
                    <span>Product</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="{{route('admin.products')}}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Products</a>
                    </li>
                   
                </ul>
            </li>
        </ul>
    </div>
</aside>