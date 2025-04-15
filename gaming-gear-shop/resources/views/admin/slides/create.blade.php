@extends('admin.layout_admin.master') 

@section('title', 'Thêm Slide Mới')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Thêm Slide Mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                 <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                </div>
                 <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                 <div class="form-group">
                    <label for="link">Đường dẫn (Link)</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}" placeholder="https://...">
                </div>
                 <div class="form-group">
                    <label for="image">Hình ảnh <span class="text-danger">*</span></label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                     <small class="form-text text-muted">Định dạng: jpeg, png, jpg, gif, svg, webp. Tối đa 2MB.</small>
                </div>
                 <div class="form-group">
                    <label for="sort_order">Thứ tự hiển thị</label>
                    <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                     <small class="form-text text-muted">Số nhỏ hơn sẽ hiển thị trước.</small>
                </div>
                 <div class="form-group">
                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm Mới</button>
                <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection