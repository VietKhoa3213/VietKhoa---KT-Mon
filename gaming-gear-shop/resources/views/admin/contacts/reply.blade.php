@extends('admin.layout_admin.master') 
@section('title', 'Phản hồi Liên hệ #' . $contact->id)

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Phản hồi Liên hệ #{{ $contact->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                 <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Tin nhắn từ Khách hàng</h6></div>
                 <div class="card-body">
                     <p><strong>Từ:</strong> {{ $contact->name }} ({{ $contact->email }})</p>
                     <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
                     <p><strong>Tiêu đề:</strong> {{ $contact->subject ?? '(Không có)' }}</p>
                     <hr>
                     <p><strong>Nội dung:</strong></p>
                     <div style="white-space: pre-wrap; background: #f8f9fa; padding: 10px; border-radius: 4px;">{{ $contact->message }}</div>
                     <hr>
                     <p><strong>Trạng thái hiện tại:</strong> <span class="badge badge-{{ $contact->status_class }}">{{ $contact->status_text }}</span></p>
                     @if($contact->replied_at)
                         <p><strong>Phản hồi lúc:</strong> {{ $contact->replied_at->format('d/m/Y H:i') }}</p>
                     @endif
                 </div>
            </div>
        </div>

         <div class="col-md-6">
             <div class="card shadow mb-4">
                  <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Soạn phản hồi</h6></div>
                   <form action="{{ route('contacts.sendReply', $contact) }}" method="POST">
                        @csrf
                        <div class="card-body">
                             <div class="form-group">
                                 <label for="reply_subject">Tiêu đề Email trả lời <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="reply_subject" name="reply_subject" value="{{ old('reply_subject', 'Re: ' . ($contact->subject ?? 'Phản hồi về liên hệ của bạn')) }}" required>
                             </div>
                             <div class="form-group">
                                 <label for="reply_message">Nội dung trả lời <span class="text-danger">*</span></label>
                                 <textarea name="reply_message" id="reply_message" rows="10" class="form-control" required>{{ old('reply_message') }}</textarea>
                             </div>
                        </div>
                        <div class="card-footer">
                             <button type="submit" class="btn btn-primary">Gửi Phản hồi</button>
                             <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Quay lại Danh sách</a>
                        </div>
                   </form>
             </div>
         </div>
    </div>

</div>
@endsection