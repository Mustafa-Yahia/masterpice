// resources/views/cause/show.blade.php
@extends('layouts.app')

@section('content')
    <h2>{{ $cause->title }}</h2>
    <img src="{{ asset('storage/images/' . $cause->image) }}" alt="{{ $cause->title }}">
    <p>{{ $cause->description }}</p>
    <p>Raised: ${{ $cause->raised_amount }} / Goal: ${{ $cause->goal_amount }}</p>
@endsection
