<!-- resources/views/donation/cart.blade.php -->
@extends('layouts.app')

@section('content')
<section class="donation-cart" style="padding: 50px 0; background-color: #f9f9f9;">
    <div class="auto-container">
        <h2 style="text-align: right; font-size: 36px;">سلة التبرعات</h2>

        @if(count($donations) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>التبرع</th>
                        <th>السعر</th>
                        <th>العدد</th>
                        <th>حذف</th>
                        <th>المجموع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation['title'] }}</td>
                            <td>{{ $donation['amount'] }} دينار أردني</td>
                            <td>{{ $donation['people_count'] }}</td>
                            <td>
                                <form action="{{ route('donation.remove', $loop->index) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                            <td>{{ $donation['total'] }} دينار أردني</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: right;">لا توجد تبرعات في السلة.</p>
        @endif

        <div style="text-align: right;">
            <a href="{{ route('donation.checkout') }}" class="btn btn-success">إتمام التبرع</a>
        </div>
    </div>
</section>
@endsection
