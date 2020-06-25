@extends('frontend.layouts.master')
@section('content')
<div class="container">
	@foreach ($categories as $category)
	<a href="" class="text-danger">{{ $category->name }}</a>
	<br><br>
	@endforeach
</div>
@endsection