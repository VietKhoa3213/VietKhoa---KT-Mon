<div class="container category-navbar-container" style="margin-top: 15px; margin-bottom: 15px; position: relative;">   
    <div class="navbar" style="justify-content: center;">
        <div class="navbar-content" style="width:auto; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #f8f9fa; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            @if(isset($categoriesForMenu) && $categoriesForMenu->count() > 0)
                @foreach ($categoriesForMenu as $category)
                    <div class="category-menu-item" style="position: relative; "> 

                        <a href="{{ route('categories.show', $category) }}" 
                           class="category-link category-dropdown-trigger" 
                           data-category-id="{{ $category->id }}"
                           data-url="{{ route('category.product.preview', $category) }}">
                            {{ $category->name }}
                            <i class="fas fa-chevron-down"></i>
                        </a>

                        <div class="category-dropdown-panel"
                             style="display: none; position: absolute; top: 100%; left: 0; /* Điều chỉnh left nếu cần căn giữa */ z-index: 1000; background: white; border: 1px solid #ccc; box-shadow: 0 5px 10px rgba(0,0,0,0.1); min-width: 350px; /* Độ rộng dropdown */">
                            <div class="dropdown-loading" style="padding: 30px; text-align: center; color: #888;">Đang tải...</div>
                        </div>

                    </div>
                @endforeach
                
            @else
                <span>Chưa có danh mục nào.</span>
            @endif
        </div>
    </div>
</div>