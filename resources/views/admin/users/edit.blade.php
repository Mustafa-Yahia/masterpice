@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding-right: 270px; padding-top: 20px; direction: rtl;">
    @include('admin.sidebar')

    <div class="content" style="background: #f9f9f9; padding: 30px; min-height: 100vh; direction: rtl;">
        <h1>تعديل المستخدم</h1>

        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-top: 20px;">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                </div>

                <div class="form-group">
                    <label>الدور</label>
                    <input type="text" name="role" class="form-control" value="{{ $user->role }}" required>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">تحديث</button>
            </form>
        </div>
    </div>
</div>
@endsection
