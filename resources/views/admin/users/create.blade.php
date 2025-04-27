@extends('layouts.admin')

@section('content')
<div class="container" style="padding-right: 270px; padding-top: 20px;">
    @include('admin.sidebar')

    <div class="content">
        <h1>إضافة مستخدم جديد</h1>

        <form action="{{ route('admin.users.store') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>رقم الهاتف</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label>الدور</label>
                <input type="text" name="role" class="form-control" required>
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success" style="margin-top: 20px;">إضافة</button>
        </form>
    </div>
</div>
@endsection
