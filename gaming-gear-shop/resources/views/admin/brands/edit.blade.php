@extends('admin.layout_admin.master') 

@section('title', 'Chỉnh Sửa Thương Hiệu')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa: {{ $brand->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên Thương Hiệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $brand->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $brand->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Logo hiện tại</label>
                    <div>
                        @if($brand->logo)
                            @if (\Str::startsWith($brand->logo, 'preview/image/brand/'))
                                <img src="{{ asset($brand->logo) }}"
                                    alt="{{ $brand->name }}"
                                        class="img-thumbnail-admin" style="width: 172px; height: 130px;object-fit: contain;">
                            @else
                                <img src="{{ asset('preview/image/brand/' . $brand->logo) }}"
                                    alt="{{ $brand->logo }}"
                                        class="img-thumbnail-admin"style="width: 172px; height: 135px; object-fit: contain;" >
                            @endif
                        @else
                            <small>Không có ảnh</small>
                        @endif
                    </div>
                    <label for="logo">Chọn logo mới (để trống nếu không đổi)</label>
                    <input type="file" class="form-control-file" id="logo" name="logo">
                     <small class="form-text text-muted">Định dạng: jpeg, png, jpg, gif, svg, webp. Tối đa 1MB.</small>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection