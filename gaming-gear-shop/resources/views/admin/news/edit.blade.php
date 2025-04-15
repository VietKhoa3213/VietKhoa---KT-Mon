@extends('admin.layout_admin.master')
@section('title', 'Chỉnh Sửa Tin Tức')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa: {{ $news->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-body">
                 <div class="form-group">
                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Nội dung <span class="text-danger">*</span></label>
                    <textarea class="form-control wysiwyg-editor" id="content" name="content" rows="10" required>{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="form-group">
                     <label>Ảnh đại diện hiện tại</label>
                     <div>
                         @if($news->image)
                             <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" height="100" class="img-thumbnail-admin mb-2">
                         @else
                             <small>Chưa có ảnh</small>
                         @endif
                     </div>
                    <label for="image">Chọn ảnh mới (để trống nếu không đổi)</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-text text-muted">Định dạng: jpeg, png, jpg, gif, svg, webp. Tối đa 2MB.</small>
                     @error('image')<span class="text-danger d-block mt-1">{{ $message }}</span>@enderror
                </div>

                 <div class="form-group">
                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ old('status', $news->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status', $news->status) == 0 ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>

                 <div class="form-group">
                     <label>Tác giả:</label>
                     <p>{{ $news->author->name ?? 'N/A' }}</p>
                 </div>
                 <div class="form-group">
                     <label>Ngày tạo:</label>
                     <p>{{ $news->created_at->format('d/m/Y H:i:s') }}</p>
                 </div>
                 <div class="form-group">
                     <label>Cập nhật lần cuối:</label>
                     <p>{{ $news->updated_at->format('d/m/Y H:i:s') }}</p>
                 </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.25.1/standard-all/ckeditor.js"></script>
<script>
     document.addEventListener('DOMContentLoaded', function() {
         document.querySelectorAll('.wysiwyg-editor').forEach(function(node) {
            CKEDITOR.replace(node.id);
         });
     });
</script>
@endpush