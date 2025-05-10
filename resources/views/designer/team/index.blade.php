@extends('layouts.designer')

@section('page-title', 'إدارة أعضاء الجمعية')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="designer-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">قائمة أعضاء الجمعية</h5>
                <a href="{{ route('designer.team.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> إضافة عضو جديد
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الصورة</th>
                                <th>الاسم</th>
                                <th>المنصب</th>
                                <th>البريد الإلكتروني</th>
                                <th>تاريخ الإضافة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td>
                                    @if($member->image)
                                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="rounded-circle" width="50" height="50">
                                    @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=random" class="rounded-circle" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->position }}</td>
                                <td>{{ $member->email ?? '--' }}</td>
                                <td>
                                    {{ $member->created_at ? $member->created_at->format('Y-m-d') : '--' }}
                                </td>
                                <td>
                                    <a href="{{ route('designer.team.edit', $member->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('designer.team.destroy', $member->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد من حذف هذا العضو؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
