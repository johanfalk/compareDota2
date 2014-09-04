@extends('default.layout')

@section('content')
	@foreach($matches as $match)
		{{ $match->match_id }}
	@endforeach
 
	<p>{{ $matches->links() }}</p>
@stop