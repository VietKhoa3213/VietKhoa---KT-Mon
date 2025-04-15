@extends('admin.layout_admin.master')
@section('title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa: {{ $product->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="card shadow mb-4">
            <div class="card-body">
                 <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Tên Sản Phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        </div>
                       <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                            @error('description') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="specifications">Thông số kỹ thuật (Nhập/Sửa dưới dạng JSON)</label>
                            <textarea class="form-control" id="specifications" name="specifications" rows="5" placeholder='{&#10;  "key": "value"&#10;}'>
                                {{ old('specifications', isset($product->specifications) ? json_encode($product->specifications, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '') }}
                            </textarea>
                            <small class="form-text text-muted">Giữ định dạng JSON hợp lệ. Để trống nếu không có.</small>
                            @error('specifications') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Thư viện ảnh hiện tại</label>
                            <div class="mb-2">
                                @php
                                    $gallery = json_decode($product->gallery ?? '[]', true);
                                    if (!is_array($gallery)) {
                                        $gallery = []; 
                                    }
                                @endphp

                                @if(!empty($gallery))
                                    @foreach($gallery as $img)
                                        @if (\Str::startsWith($img, 'preview/image/product/gallery/'))
                                            <img src="{{ asset($img) }} " 
                                                style="width: 200px; height: 150px;object-fit: cover;"
                                                alt="Gallery Image"
                                                height="20" 
                                                class="img-thumbnail img-thumbnail-admin"> 
                                        @else
                                            <img src="{{ asset('preview/image/product/gallery/' . $img) }}"
                                                style="width: 200px; height: 150px;object-fit: cover;" 
                                                alt="Gallery Image"
                                                height="20" 
                                                class="img-thumbnail img-thumbnail-admin"> 
                                        @endif
                                    @endforeach
                                @else
                                    <small>Không có ảnh gallery.</small>
                                @endif
                            </div>
                            <label for="gallery">Tải lên ảnh mới (sẽ thay thế toàn bộ ảnh cũ)</label>
                            <input type="file" class="form-control-file" id="gallery" name="gallery[]" multiple>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Loại Sản Phẩm <span class="text-danger">*</span></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">-- Chọn loại --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Thương Hiệu <span class="text-danger">*</span></label>
                            <select class="form-control" id="brand_id" name="brand_id" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá gốc <span class="text-danger">*</span></label>
                            <input type="number" step="1000" min="0" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="discount_price">Giá khuyến mãi</label>
                            <input type="number" step="1000" min="0" class="form-control" id="discount_price" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}">
                        </div>
                        <div class="form-group">
                            <label for="stock_quantity">Số lượng tồn kho <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                        </div>
                         <div class="form-group">
                            <label for="unit">Đơn vị tính</label>
                            <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit', $product->unit) }}">
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện hiện tại</label>
                            <div>
                                @if($product->image)    
                                        @if (\Str::startsWith($product->image, 'preview/image/product/'))
                                            <img src="{{ asset($product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="img-thumbnail-admin" style="width: 172px; height: 130px;object-fit: contain;">
                                        @else
                                            <img src="{{ asset('preview/image/product/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="img-thumbnail-admin"style="width: 172px; height: 135px;object-fit: contain; " >
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                            </div>
                            <label for="image">Chọn ảnh mới (để trống nếu không đổi)</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_new">Sản phẩm mới</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Sản phẩm nổi bật</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $product->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Đang bán (active)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection

 @push('scripts')
<script src="https://cdn.ckeditor.com/4.25.1/standard-all/ckeditor.js"></script>
 <script>
     CKEDITOR.replace( 'description' );
     CKEDITOR.replace( 'specifications' );
 </script>
 @endpush