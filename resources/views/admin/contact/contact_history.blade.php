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
</section>
@endsection