@extends('layouts.designer')

@section('page-title', 'إضافة عضو جديد')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="designer-card">
            <div class="card-header">
                <h5 class="mb-0">إضافة عضو جديد</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('designer.team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label">المنصب</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="twitter" class="form-label">رابط تويتر</label>
                                <input type="url" class="form-control" id="twitter" name="twitter" placeholder="https://twitter.com/username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="linkedin" class="form-label">رابط لينكد إن</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">صورة العضو</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                            <a href="{{ route('designer.team.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
