@extends('admin.layout_admin.master') 
@section('title', 'Thêm Sản Phẩm Mới')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Thêm Sản Phẩm Mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Nhớ enctype cho upload file --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    {{-- Cột trái --}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Tên Sản Phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            @error('description') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="specifications">Thông số kỹ thuật (Nhập dưới dạng JSON)</label>
                            <textarea class="form-control" id="specifications" name="specifications" rows="5" placeholder='{&#10;  "driver": "53mm",&#10;  "connection": "USB/3.5mm",&#10;  "surround": "7.1 Virtual"&#10;}'>{{ old('specifications') }}</textarea>
                            <small class="form-text text-muted">Ví dụ: {"Kích thước": "10x20cm", "Màu sắc": "Đen"}. Để trống nếu không có.</small>
                            @error('specifications') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="gallery">Thư viện ảnh (chọn nhiều ảnh)</label>
                            <input type="file" class="form-control-file" id="gallery" name="gallery[]" multiple>
                        </div>
                    </div>
                    {{-- Cột phải --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Loại Sản Phẩm <span class="text-danger">*</span></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">-- Chọn loại --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá gốc <span class="text-danger">*</span></label>
                            <input type="number" step="1000" min="0" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="discount_price">Giá khuyến mãi</label>
                            <input type="number" step="1000" min="0" class="form-control" id="discount_price" name="discount_price" value="{{ old('discount_price') }}">
                        </div>
                        <div class="form-group">
                            <label for="stock_quantity">Số lượng tồn kho <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" required>
                        </div>
                         <div class="form-group">
                            <label for="unit">Đơn vị tính</label>
                            <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit', 'Cái') }}">
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh đại diện</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_new">Sản phẩm mới</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Sản phẩm nổi bật</label>
                        </div>
                        <div class="form-check">
                            {{-- Mặc định là check vào 'Đang bán' khi tạo mới --}}
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Đang bán (active)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm Mới</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection