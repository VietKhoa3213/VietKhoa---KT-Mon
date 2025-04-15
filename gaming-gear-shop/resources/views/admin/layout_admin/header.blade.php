<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('admin.dashboard') ?? '#' }}">Admin Panel</a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                 @auth
                    {{ Auth::user()->name }}
                 @endauth
                 <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a> 
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> 
                </li>
                <li class="divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="admin-logout-form" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                       <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
                </li>
            </ul>
            </li>
        </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fa fa-sitemap fa-fw"></i> Loại Sản Phẩm<span class="fa arrow"></span> 
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.create') }}" class="{{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">Thêm mới</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                        <i class="fa fa-tags fa-fw"></i> Thương Hiệu<span class="fa arrow"></span> 
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.index') ? 'active' : '' }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.brands.create') }}" class="{{ request()->routeIs('admin.brands.create') ? 'active' : '' }}">Thêm mới</a>
                        </li>
                    </ul>
                </li>
                <li>
                     <a href="#" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fa fa-cube fa-fw"></i> Sản Phẩm<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">Danh sách</a> 
                        </li>
                        <li>
                            <a href="{{ route('admin.products.create') }}" class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">Thêm mới</a> 
                        </li>
                    </ul>
                    </li>
                <li>
                     <a href="#" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Người Dùng<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.create') }}" class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">Thêm mới</a> 
                        </li>
                    </ul>
                    </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="fa fa-newspaper-o fa-fw"></i> Tin Tức<span class="fa arrow"></span> 
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.index') ? 'active' : '' }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.news.create') }}" class="{{ request()->routeIs('admin.news.create') ? 'active' : '' }}">Thêm mới</a>
                        </li>
                    </ul>
                </li>


                  <li>
                    
                    <a href="#" class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                        <i class="fa fa-shopping-cart fa-fw"></i> Đơn Hàng<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="{{ !request()->filled('status') && request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                                Tất cả đơn hàng
                            </a>
                        </li>
                        <li>
                            @php $statusCode = \App\Models\Order::STATUS_PENDING; @endphp
                            <a href="{{ route('admin.orders.index', ['status' => $statusCode]) }}"
                            class="{{ request()->input('status') == $statusCode ? 'active' : '' }}">
                            {{ \App\Models\Order::getAllStatuses()[$statusCode] ?? 'Mới' }}
                            </a>
                        </li>
                        <li>
                            @php $statusCode = \App\Models\Order::STATUS_PROCESSING; @endphp
                            <a href="{{ route('admin.orders.index', ['status' => $statusCode]) }}"
                            class="{{ request()->input('status') == $statusCode ? 'active' : '' }}">
                            {{ \App\Models\Order::getAllStatuses()[$statusCode] ?? 'Đang xử lý' }}
                            </a>
                        </li>
                        <li>
                            @php $statusCode = \App\Models\Order::STATUS_SHIPPED; @endphp
                            <a href="{{ route('admin.orders.index', ['status' => $statusCode]) }}"
                            class="{{ request()->input('status') == $statusCode ? 'active' : '' }}">
                                {{ \App\Models\Order::getAllStatuses()[$statusCode] ?? 'Đang giao' }}
                            </a>
                        </li>
                        <li>
                            @php $statusCode = \App\Models\Order::STATUS_DELIVERED; @endphp
                            <a href="{{ route('admin.orders.index', ['status' => $statusCode]) }}"
                            class="{{ request()->input('status') == $statusCode ? 'active' : '' }}">
                                {{ \App\Models\Order::getAllStatuses()[$statusCode] ?? 'Đã giao' }}
                            </a>
                        </li>
                        <li>
                            @php $statusCode = \App\Models\Order::STATUS_CANCELLED; @endphp
                            <a href="{{ route('admin.orders.index', ['status' => $statusCode]) }}"
                            class="{{ request()->input('status') == $statusCode ? 'active' : '' }}">
                                {{ \App\Models\Order::getAllStatuses()[$statusCode] ?? 'Đã hủy' }}
                            </a>
                        </li>
                    </ul>
                </li>
                 <li>
                     <a href="#" class="{{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                        <i class="fa fa-image fa-fw"></i> Slide<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.slides.index') }}" class="{{ request()->routeIs('admin.slides.index') ? 'active' : '' }}">Danh sách Slide</a> 
                        </li>
                        <li>
                            <a href="{{ route('admin.slides.create') }}" class="{{ request()->routeIs('admin.slides.create') ? 'active' : '' }}">Thêm Slide</a>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <i class="fa fa-envelope fa-fw"></i> Liên Hệ Khách Hàng
                    </a>
                </li>
                <li>
                    <a href="{{ route('reviews.index') }}" class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <i class="fa fa-comments fa-fw"></i> Quản lý Đánh giá
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </nav>