    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="welcome-text">
                  
                    @auth
                        <span class="font-weight-bold"> Xin chào {{ Auth::user()->name }}</span>!
                    @endauth
                </div>
                 @auth 
                <div class="top-actions">
                   
                        <div class="top-action-item">
                            <a href="{{ route('profile.orders') }}" style="text-decoration: none; color: inherit;" title="Xem lịch sử đơn hàng">
                                <i class="fas fa-truck"></i>
                                <span>Lịch sử đơn hàng</span> 
                            </a>
                        </div>
                    
                 @endauth
                    <div class="top-action-item">
                        <a href="{{ route('contact.create') }}" 
                        style="text-decoration: none; color: inherit;"
                        title="Gửi liên hệ cho chúng tôi"> 
                            <i class="fas fa-envelope"></i> 
                            <span>Liên hệ</span> 
                        </a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
    <!-- Header chính -->
    <header>
        <div class="container">
            <div class="header-content">
                <button class="menu-button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href={{route('home')}} class="logo">MegaMart</a>
                <div class="search-bar">
                    <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center position-relative"> 
                        <i class="fas fa-search search-icon" style="position: absolute; left: 10px; color: #aaa;"></i>
                        <input type="text"
                            name="query" 
                            class="form-control search-input ps-4"
                            placeholder="Tìm kiếm sản phẩm..."
                            value="{{ request('query') }}" 
                            required 
                            style="padding-left: 2.5rem !important;"> 
                    </form>
                </div>
               <div class="nav-links">

                    @guest
                        <a href="{{ route('register') }}" class="nav-link auth-link">Đăng Ký</a>
                        <a href="{{ route('login') }}" class="nav-link auth-link">Đăng Nhập</a>
                    @endguest

                    @auth

                        @if (Auth::user()->level == 1)
                            <a href="{{ route('admin.dashboard') }}" class="nav-link admin-link"> 
                                <i class="fas fa-tachometer-alt"></i> 
                                Trang quản trị
                            </a>
                            
                        @else
                            <a href="{{ route('profile.show') }}" class="nav-link admin-link user-greeting" alt="Trang cá nhân của bạn" title="Trang cá nhân của bạn"> 
                                <span class=" " style="cursor: default;">
                                    Chào, {{ Auth::user()->name }}
                                </span>
                            </a>
                        @endif
                            
                        <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 8px;">
                            @csrf
                            <a href="{{ route('logout') }}"
                            class="nav-link auth-link logout-link"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Đăng Xuất
                        </a>
                    </form>
                        <a href="{{ route('wishlist.index') }}" class="nav-link wishlist-link ml-2" title="Danh sách yêu thích">
                            <i class="fas fa-heart"></i> 
                            @if(isset($wishlistCount) && $wishlistCount > 0)
                                <span class="badge badge-warning ml-1 wishlist-count-badge" style="color: black; font-size: 1em;"> 
                                    ({{ $wishlistCount }})
                                </span>
                            @endif
                        </a>
                @endauth

            <div class="cart-dropdown-container" style="position: relative; display: inline-block;">
                <a href="{{ route('cart.index') }}" class="nav-link cart-button cart-dropdown-trigger"> 
                    <i class="fas fa-shopping-cart"></i>
                    Giỏ Hàng
                    @if(isset($cartItemCount) && $cartItemCount > 0)
                        <span class="badge badge-danger ml-1 cart-count-badge" style="font-size: 0.7em; vertical-align: top; font-size: medium; color: black;"> 
                        ({{ $cartItemCount }})
                        </span>
                    @endif
                    <i class="fas fa-chevron-down"></i>
                </a>
                


            <div class="cart-dropdown-panel shadow-lg border rounded-lg bg-white" style="display: none; position: absolute; top: 100%; right: 0; z-index: 1050; min-width: 320px; max-width: 380px;">
                    <div class="cart-dropdown-header px-4 py-3 border-bottom d-flex justify-content-between align-items-center bg-light rounded-top">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-shopping-cart mr-2 text-primary"></i>Giỏ hàng của bạn
                            @if(isset($cartItems) && !empty($cartItems))
                                <span class="badge badge-pill badge-primary ml-2">{{ count($cartItems) }}</span>
                            @endif
                        </h6>
                    
                    </div>
                
                <div class="cart-dropdown-body">
                    @if(isset($cartItems) && !empty($cartItems))
                        <ul class="list-group list-group-flush" style="max-height: 350px; overflow-y: auto;"> 
                            @foreach ($cartItems as $id => $item)
                                <li class="list-group-item px-3 py-2 d-flex justify-content-between align-items-center hover-bg-light position-relative cart-dropdown-item"> {{-- Thêm cart-dropdown-item --}}
                                    <div class="d-flex align-items-center flex-grow-1 pr-4 cart-item-primary"> 
                                        @php
                                            $itemImageUrl = $item['image'] ? asset($item['image']) : asset('images/placeholder_thumb.png');
                                        @endphp
                                        
                                    <div class="cart-item-image"> 
                                        @php
                                            $itemImageValue = $item['image'] ?? null; 
                                            $itemImageUrl = asset('images/placeholder_thumb.png');

                                            if ($itemImageValue) {
                                                $prefixes = ['http://', 'https://', 'preview/image/product/']; 

                                                if (Str::startsWith($itemImageValue, $prefixes)) {
                                                    $itemImageUrl = asset($itemImageValue); 
                                                } else {
                                                    $itemImageUrl = asset('preview/image/product/' . $itemImageValue);
                                                }
                                            }
                                        @endphp
                                        <img src="{{ $itemImageUrl }}"
                                            alt="{{ $item['name'] ?? 'Sản phẩm' }}"
                                            width="50" height="50" 
                                            class="rounded" style="object-fit: cover; border: 1px solid #eee;">
                                    </div>
                                        
                                       <div class="ml-3 cart-item-details" style="line-height: 1.4; flex-grow: 1; min-width: 0;">
                                            <div class="font-weight-medium text-truncate cart-item-name" style="max-width: 180px;" title="{{ $item['name'] ?? 'Sản phẩm' }}">
                                                {{ $item['name'] ?? 'Sản phẩm' }}
                                            </div>
                                           <div class="d-flex justify-content-between align-items-center mt-1 cart-item-qty-price"> 
                                                <div class="d-flex align-items-center">
                                                    <div class="item-quantity d-flex align-items-center">
                                                       <button class="btn px-1 py-0 quantity-btn" data-action="decrease" data-id="{{ $id }}">
                                                            <i class="fas fa-minus text-secondary small"></i>
                                                        </button>
                                                        <span class="mx-2 text-muted">{{ $item['quantity'] ?? 0 }}</span>
                                                        <button class="btn px-1 py-0 quantity-btn" data-action="increase" data-id="{{ $id }}">
                                                            <i class="fas fa-plus text-secondary small"></i>
                                                        </button>
                                                    </div>
                                                    <span class="text-muted mx-2">&times;</span>
                                                    <span class="text-muted">{{ number_format($item['price'] ?? 0, 0, ',', '.') }}₫</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-right cart-item-subtotal">
                                        <span class="font-weight-bold text-nowrap">
                                            {{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 0, ',', '.') }}₫
                                        </span>
                                    </div>
                                    
                                        <button class="btn btn-sm text-danger position-absolute remove-cart-item" style="top: 5px; right: 5px;" title="Xóa sản phẩm" data-id="{{ $id }}">
                                            <i class="fas fa-times fa-xs"></i> 
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <div class="p-4 text-center empty-cart cart-empty-message">
                                    <div class="mb-3">
                                        <i class="fas fa-shopping-basket fa-3x text-muted"></i>
                                    </div>
                                    <p class="text-muted mb-3">Giỏ hàng của bạn đang trống</p>
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-arrow-left mr-1"></i> Tiếp tục mua sắm
                                    </a>
                                </div>
                            @endif
                        </div>


                     @if(isset($cartItems) && !empty($cartItems))
                        <div class="cart-dropdown-footer border-top p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span>Số lượng sản phẩm:</span>
                                <span>{{ array_sum(array_column($cartItems, 'quantity')) }}</span>
                            </div>
                                    
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>Tổng tạm tính:</strong>
                                <strong class="text-danger h5 mb-0 total-amount">{{ number_format($cartSubtotal ?? 0, 0, ',', '.') }}₫</strong>
                            </div>
                                    
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-shopping-cart mr-1"></i> Xem giỏ hàng
                                </a>
                                <a href="{{ route('checkout.index') }}#" class="btn btn-primary">
                                    <i class="fas fa-check mr-1"></i> Thanh toán
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

        </div>
    </header>



