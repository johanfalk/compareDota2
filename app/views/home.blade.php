@extends('default.layout')

@section('header')

	<h2>Compare Dota 2</h2>

	<p>View and compare you statistics by entring a Steam ID!</p>

	@if (Session::has('message'))
		{{ Session::get('message') }}
	@endif

@stop

@section('content')

	{{ Form::open(array('id' => 'steamIdForm')) }}

	{{ Form::label('steamid', 'Steam ID') . Form::text('steamid') }}
	
	{{ Form::submit('View') }}
	
	{{ Form::close() }}
	
	{{ HTML::image('images/loading.gif', 'Loading', array('id' => 'loading-gif')); }}

@stop