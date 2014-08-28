@extends('default.layout')

@section('header')

	<h2>Compare Dota 2</h2>

	<p>View and compare you statistics by entring a Steam ID!</p>

	@if (Session::has('message'))
		{{ Session::get('message') }}
	@endif

@stop

@section('content')

	{{ Form::open(array('id' => 'steamIDForm')) }}

	{{ Form::label('steamID', 'Steam ID') . Form::text('steamID') }}
	
	{{ Form::submit('View') }}
	
	{{ Form::close() }}
	
	{{ HTML::image('images/loading.gif', 'Loading', array('id' => 'loading-gif')); }}

@stop