@extends('admin.layout_admin.master') 

@section('title', 'Chỉnh Sửa Loại Sản Phẩm')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa: {{ $category->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên Loại Sản Phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh hiện tại</label>
                    <div>
                        @if($category->image)
                                        
                                        @if (\Str::startsWith($category->image, 'preview/image/category/'))
                                            <img src="{{ asset($category->image) }}"
                                                alt="{{ $category->name }}"
                                                class="img-thumbnail-admin" style="width: 170px; height: 130px;object-fit: contain;">
                                        @else
                                            <img src="{{ asset('preview/image/category/' . $category->image) }}"
                                                alt="{{ $category->name }}"
                                                class="img-thumbnail-admin"style="width: 170px; height: 130px;object-fit: contain;" >
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                    </div>
                    <label for="image">Chọn ảnh mới (để trống nếu không muốn thay đổi)</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                     <small class="form-text text-muted">Định dạng: jpg, jpeg, png, gif, svg, webp. Tối đa 2MB.</small>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection