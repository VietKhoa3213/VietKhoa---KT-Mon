@extends('admin.layout_admin.master') 
@section('title', 'Chỉnh Sửa Slide')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa Slide</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('admin.slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $slide->title) }}">
                </div>
                 <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $slide->description) }}</textarea>
                </div>
                 <div class="form-group">
                    <label for="link">Đường dẫn (Link)</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $slide->link) }}" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label>Ảnh hiện tại</label>
                    <div>
                        @if($slide->image)
                                        @if (\Str::startsWith($slide->image, 'preview/image/slides/'))
                                            <img src="{{ asset($slide->image) }}"
                                                alt="{{ $slide->name }}"
                                                class="img-thumbnail-admin" style="width: 252px; height: 100px;object-fit: ;">
                                        @else
                                            <img src="{{ asset('preview/image/slides/' . $slide->image) }}"
                                                alt="{{ $slide->name }}"
                                                class="img-thumbnail-admin"style="width: 252px; height: 100px;object-fit: ; " >
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                    </div>
                    <label for="image">Chọn ảnh mới (để trống nếu không đổi)</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                     <small class="form-text text-muted">Định dạng: jpeg, png, jpg, gif, svg, webp. Tối đa 2MB.</small>
                     @error('image')<span class="text-danger d-block mt-1">{{ $message }}</span>@enderror
                </div>
                 <div class="form-group">
                    <label for="sort_order">Thứ tự hiển thị</label>
                    <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $slide->sort_order) }}">
                     <small class="form-text text-muted">Số nhỏ hơn sẽ hiển thị trước.</small>
                </div>
                 <div class="form-group">
                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ old('status', $slide->status) == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('status', $slide->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection