<!-- resources/views/designer/timeline/edit.blade.php -->
@extends('layouts.designer')

@section('title', 'تعديل حدث')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold"><i class="fas fa-edit me-2"></i>تعديل حدث</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card designer-card">
                <div class="card-body">
                    <form action="{{ route('designer.timeline.update', $timeline->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="year" class="form-label">السنة</label>
                            <input type="number" class="form-control" id="year" name="year"
                                   value="{{ $timeline->year }}" required min="1900" max="{{ date('Y') + 5 }}">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">العنوان</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ $timeline->title }}" required maxlength="255">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="description" name="description"
                                      rows="5" required>{{ $timeline->description }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">حفظ التغييرات</button>
                            <a href="{{ route('designer.timeline.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
