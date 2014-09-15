@extends('default.layout')

@section('mainMenu')
	
	<h2>Compare Dota 2</h2>

	<ul>
		<li><a href="#">Heroes</a></li>
		<li><a href="#">Items</a></li>
		<li><a href="#">News</a></li>
	</ul>
	
@stop

@section('header')

	<p>View and compare you statistics</p>

@stop

@section('content')

	{{ Form::open(array('id' => 'steamIDForm')) }}

	{{ Form::label('steamID', 'Steam ID') . Form::text('steamID') }}
	
	{{ Form::submit('View') }}
	
	{{ Form::close() }}
	
	{{ HTML::image('images/loading.gif', 'Loading', array('id' => 'loading-gif')); }}

	<!--<h4>76561198011435968</h4>
		<h4>76561198040172380</h4>-->
	@if (Session::has('message'))
		{{ Session::get('message') }}
	@endif
@stop