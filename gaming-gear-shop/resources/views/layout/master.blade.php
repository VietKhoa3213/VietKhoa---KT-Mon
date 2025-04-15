<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MegaMart - Trang chủ</title>
    <link rel="stylesheet" href="{{asset('preview/style.css')}}">
    <link rel="stylesheet" href="{{asset("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("https://unpkg.com/swiper/swiper-bundle.min.css" )}}"/>
    <link rel="stylesheet" href="{{asset("https://unpkg.com/swiper/swiper-bundle.min.css" )}}"/>
    <link rel="stylesheet" href="{{asset("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css")}}">
    <link href="{{asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css")}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
       
</head>
<body>
@include('layout.header')
 @include('partials.category_navbar')

@yield('content')
{{--  <a href="https://m.me/431242717470915"
   target="_blank" 
   rel="noopener noreferrer" 
   style="position: fixed; bottom: 25px; right: 25px; z-index: 1000; transition: transform 0.2s ease;" 
   title="Chat với chúng tôi qua Messenger" 
   onmouseover="this.style.transform='scale(1.1)'"
   onmouseout="this.style.transform='scale(1)'" >
    <i class="fab fa-facebook-messenger fa-3x" style="color: #0084FF;"></i> 
</a>  --}}



@include('layout.footer')




@yield('js')
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js")}}"></script>
    <script src="{{asset("https://unpkg.com/swiper/swiper-bundle.min.js")}}"></script>
    <script src="{{ asset('source/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('source/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/67fa13060d9928190ebbc40e/1iokdkkq1';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
         console.error('CSRF Token meta tag not found!');
    }

    const menuItems = document.querySelectorAll('.category-menu-item');
    let categoryLeaveTimeout;
    let currentOpenCategoryPanel = null;


    menuItems.forEach((item, index) => {
        const triggerLink = item.querySelector('.category-dropdown-trigger');
        const panel = item.querySelector('.category-dropdown-panel');
        if (!triggerLink || !panel) {
            console.error(`Category Item ${index}: Missing trigger or panel.`);
            return;
        }
        const previewUrl = triggerLink.dataset?.url;
        let isContentLoaded = false;

        const showPanel = () => {
            if(currentOpenCategoryPanel && currentOpenCategoryPanel !== panel) {
                currentOpenCategoryPanel.style.display = 'none';
            }
            panel.style.display = 'block';
            currentOpenCategoryPanel = panel;
            if (!isContentLoaded && previewUrl) {
                isContentLoaded = true; 
                loadCategoryPanelContent(panel, previewUrl);
            } else if (isContentLoaded) {
            } else if (!previewUrl) {
                if(!panel.querySelector('.no-preview')) { 
                     panel.innerHTML = '<div class="no-preview" style="padding: 20px; text-align: center; color: #888;">Không có dữ liệu xem trước.</div>';
                }
            }
        };
        const hidePanel = () => { panel.style.display = 'none'; if(currentOpenCategoryPanel === panel) currentOpenCategoryPanel = null; };

        item.addEventListener('mouseenter', () => { clearTimeout(categoryLeaveTimeout); showPanel(); });
        item.addEventListener('mouseleave', () => { categoryLeaveTimeout = setTimeout(hidePanel, 300); });
    });

    async function loadCategoryPanelContent(panelElement, url) {
        const loadingElement = panelElement.querySelector('.dropdown-loading');
        try {
            if(loadingElement) loadingElement.style.display = 'block'; else panelElement.innerHTML = '<div class="dropdown-loading" style="padding: 30px; text-align: center; color: #888;">Đang tải...</div>'; // Thêm loading nếu chưa có
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!response.ok) { let errorBody = await response.text(); console.error('[CATEGORY ERROR BODY]:', errorBody.substring(0, 500)); throw new Error(`HTTP error! status: ${response.status}`); }
            const html = await response.text();
            if (html && html.trim().length > 0) panelElement.innerHTML = html;
            else panelElement.innerHTML = '<div style="padding:20px;text-align:center;color:orange;">Nội dung xem trước trống.</div>';
        } catch (error) {
            console.error(`[CATEGORY AJAX CATCH] for ${url}:`, error);
            panelElement.innerHTML = '<div style="padding:20px;color:red;text-align:center;">Lỗi tải dữ liệu.</div>';
        }
    }


    const cartContainer = document.querySelector('.cart-dropdown-container'); 
    const cartPanel = document.querySelector('.cart-dropdown-panel');     
    let cartLeaveTimeout; 

    if (cartContainer && cartPanel) {
        const showCartPanel = () => { clearTimeout(cartLeaveTimeout); cartPanel.style.display = 'block'; };
        const hideCartPanel = () => { cartPanel.style.display = 'none'; };
        cartContainer.addEventListener('mouseenter', showCartPanel);
        cartContainer.addEventListener('mouseleave', () => { cartLeaveTimeout = setTimeout(hideCartPanel, 300); });

        cartContainer.addEventListener('click', function(event) {
            const button = event.target.closest('.quantity-btn, .remove-cart-item');
            if (!button) return;
            event.preventDefault();
            const productId = button.dataset.id;
            const action = button.dataset.action;
             console.log(`Cart Action: Action=<span class="math-inline">\{action\}, ProductID\=</span>{productId}`);

            if (button.classList.contains('quantity-btn')) {
                const quantityElement = button.closest('.item-quantity')?.querySelector('span');
                if (!quantityElement) return;
                let currentQuantity = parseInt(quantityElement.textContent);
                let newQuantity = (action === 'increase') ? currentQuantity + 1 : currentQuantity - 1;
                if (newQuantity >= 1) { updateCartQuantity(productId, newQuantity, cartPanel); }
                else if (newQuantity === 0 && confirm('Xóa sản phẩm?')) { removeCartItem(productId, cartPanel); }
            } else if (button.classList.contains('remove-cart-item') && confirm('Xóa sản phẩm?')) {
                removeCartItem(productId, cartPanel);
            }
        });
    } else {
        console.warn('Cart dropdown container or panel element not found.');
    }

    async function updateCartQuantity(productId, quantity, panelElement) {
        const url = `/cart/update/${productId}`;
        if (!csrfToken) { console.error('CSRF Token not found!'); return; }
        console.log(`[CART AJAX UPDATE] PATCH ${url} Qty: ${quantity}`);
        try {
            const response = await fetch(url, { method: 'PATCH', headers: {'Content-Type':'application/json','Accept':'application/json','X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN':csrfToken }, body: JSON.stringify({ quantity }) });
            const result = await response.json();
            console.log('[CART AJAX UPDATE] Response:', result);
            if (result.success) updateCartDropdown(result, panelElement);
            else alert(result.message || 'Lỗi cập nhật');
        } catch (error) { console.error('[CART AJAX UPDATE] Error:', error); alert('Lỗi kết nối cập nhật.'); }
    }

    async function removeCartItem(productId, panelElement) {
        const url = `/cart/remove/${productId}`;
         if (!csrfToken) { console.error('CSRF Token not found!'); return; }
        console.log(`[CART AJAX REMOVE] DELETE ${url}`);
        try {
            const response = await fetch(url, { method: 'DELETE', headers: {'Accept':'application/json','X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN':csrfToken } });
            const result = await response.json();
             console.log('[CART AJAX REMOVE] Response:', result);
            if (result.success) {
                const itemLi = panelElement.querySelector(`button[data-id="${productId}"]`)?.closest('li.list-group-item');
                if(itemLi) { itemLi.style.opacity = '0'; setTimeout(() => itemLi.remove(), 300); }
                else { updateCartDropdown(result, panelElement); }
                setTimeout(() => updateCartDropdown(result, panelElement), 310);
            } else { alert(result.message || 'Lỗi xóa'); }
        } catch (error) { console.error('[CART AJAX REMOVE] Error:', error); alert('Lỗi kết nối xóa.'); }
    }

    function updateCartDropdown(resultData, panelElement) {
         const cartCountBadge = document.querySelector('.cart-count-badge');
         if (cartCountBadge) {
             if (resultData.cartItemCount > 0) { cartCountBadge.textContent = resultData.cartItemCount; cartCountBadge.style.display = 'inline-block';}
             else { cartCountBadge.style.display = 'none'; }
         }
         const subtotalElement = panelElement?.querySelector('.cart-dropdown-subtotal .total-amount');
         if (subtotalElement) { subtotalElement.textContent = resultData.cartSubtotalFormatted; }
         if (resultData.itemId && typeof resultData.newQuantity !== 'undefined') {
             const itemLi = panelElement.querySelector(`button[data-id="${resultData.itemId}"]`)?.closest('li.list-group-item');
             if(itemLi) {
                 const qtySpan = itemLi.querySelector('.item-quantity span');
                 const subtotalSpan = itemLi.querySelector('.cart-item-subtotal span');
                 if(qtySpan) qtySpan.textContent = resultData.newQuantity;
                 if(subtotalSpan) subtotalSpan.textContent = resultData.newItemSubtotalFormatted;
             }
         }
         const itemList = panelElement.querySelector('.cart-dropdown-body ul');
         const footer = panelElement.querySelector('.cart-dropdown-footer');
         const body = panelElement.querySelector('.cart-dropdown-body');
         const emptyCartMsg = panelElement.querySelector('.cart-empty-message');
         if (resultData.cartItemCount <= 0) {
             if(itemList) itemList.innerHTML = '';
             if(footer) footer.style.display = 'none';
             if(emptyCartMsg) { emptyCartMsg.style.display = 'block'; }
             else if (body) { body.innerHTML = '<div class="p-4 text-center empty-cart cart-empty-message"><div class="mb-3"><i class="fas fa-shopping-basket fa-3x text-muted"></i></div><p class="text-muted mb-3">Giỏ hàng của bạn đang trống</p><a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Tiếp tục mua sắm</a></div>'; }
         } else {
             if(footer) footer.style.display = 'block';
             if(emptyCartMsg) emptyCartMsg.style.display = 'none';
         }
    }

     const heroSwiper = new Swiper('.hero-slider', {
         loop: true,
         autoplay: { delay: 5000, disableOnInteraction: false },
         pagination: { el: '.swiper-pagination', clickable: true },
         navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
         effect: 'cube', 
         grabCursor: true,
         cubeEffect: { shadow: true, slideShadows: true, shadowOffset: 20, shadowScale: 0.94 },
     });

});
</script>
</body>
</html>