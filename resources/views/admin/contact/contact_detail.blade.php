@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" href="{{ asset('public/backend/css/contact.css') }}">
<section class="panel">
    <header class="panel-heading">
        Chi tiết liên hệ
    </header>
    <div class="panel-body">
        <table border='1' cellspacing='0'>
        <tr>
                <th>Tên khách hàng</th>
                <td>{{ $contact->customer_name }}</td>
            </tr>
            <tr>
                <th>SĐT</th>
                <td>{{ $contact->customer_phone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $contact->Email }}</td>
            </tr>
            <tr>
                <th>Tiêu đề</th>
                <td>{{ $contact->contact_title }}</td>
            </tr>
            <tr>
                <th>Câu hỏi</th>
                <td>{{ $contact->contact_question }}</td>
            </tr>
            <tr>
                <th>Phản hồi - Tiêu đề</th>
                <td>{{ $contact->reply_title }}</td>
            </tr>
            <tr>
                <th>Phản hồi - Nội dung</th>
                <td>{{ $contact->reply_content }}</td>
            </tr>
        </table>
    </div>

    <div class="panel-body">
        <form action="{{ route('send.email.to.customer') }}" method="POST">
            @csrf
            <input type="hidden" name="stt" value="{{ $contact->contact_id }}">
            <input type="hidden" name="customer_email" value="{{ $contact->Email }}">
            <div class="form-group">
                <label for="email_subject">Tiêu đề email:</label>
                <input type="text" name="email_subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email_body">Nội dung email:</label>
                <textarea name="email_body" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi email</button>
        </form>
    </div>
</section>
@endsection