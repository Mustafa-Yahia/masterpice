<!-- resources/views/designer/timeline/index.blade.php -->
@extends('layouts.designer')

@section('title', 'إدارة الجدول الزمني')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold"><i class="fas fa-stream me-2"></i>الجدول الزمني</h2>
            <a href="{{ route('designer.timeline.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> إضافة حدث جديد
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card designer-card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>السنة</th>
                                    <th>العنوان</th>
                                    <th>الوصف</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                <tr>
                                    <td>{{ $event->year }}</td>
                                    <td>{{ Str::limit($event->title, 30) }}</td>
                                    <td>{{ Str::limit($event->description, 50) }}</td>
                                    <td>{{ $event->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('designer.timeline.edit', $event->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('designer.timeline.destroy', $event->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا توجد أحداث مسجلة</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
