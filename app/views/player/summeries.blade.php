@extends('default.layout')

@section('header')

	<h1> {{ $player->profile->personaname }} </h1>

	<img src="{{ $player->profile->avatarmedium }}"/>
	
	<p>Link to <a href="{{ $player->profile->profileurl }}">profile!</a></p>

@stop

@section('content')

<table>

	@if($matchDetails)
		
		<tr>
		    <th>Hero</th>
		    <th>Kills</th>
		    <th>Deaths</th>
		    <th>Assists</th>
		    <th>Gold Per Min</th>
		    <th>Exp Per Min</th>
		</tr>

	@endif
	
	@foreach($matchDetails as $match)
	
	{{ dd($match) }}
	<tr>	
	
		<td>{{ $match->hero_id }}</td>
		<td>{{ $match->kills }}</td>
		<td>{{ $match->deaths }}</td>
		<td>{{ $match->assists }}</td>
		<td>{{ $match->gold_per_min }}</td>
		<td>{{ $match->xp_per_min }}</td>

	</tr>

	@endforeach
</table>

{{ $matchDetails->links() }}

@stop