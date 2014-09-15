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

	<h1> {{ $player->profile->personaname }} </h1>

	<a href="{{ $player->profile->profileurl }}">
		<img src="{{ $player->profile->avatarmedium }}"/>
	</a>

@stop

@section('content')

	<table>

		@if($matches)
			
			<tr>
			    <th>Hero</th>
			    <th>Level</th>
			    <th>Kills</th>
			    <th>Deaths</th>
			    <th>Assists</th>
			    <th>Gold Per Min</th>
			    <th>Exp Per Min</th>
			    <th>Duration</th>
			</tr>

		@endif
		
		@foreach($matches as $match)
		
		<tr class="match-detail" leaver-status="{{ $match->leaver_status }}" radiant-win="{{ $match->match_detail->radiant_win }}">	
		
			<td>{{ $match->hero->name }}</td>
			<td>{{ $match->level }}</td>
			<td>{{ $match->kills }}</td>
			<td>{{ $match->deaths }}</td>
			<td>{{ $match->assists }}</td>
			<td>{{ $match->gold_per_min }}</td>
			<td>{{ $match->xp_per_min }}</td>
			<th>{{ date("H:i:s", $match->match_detail->duration) }}</th>

		</tr>

		@endforeach

	</table>

	{{ $matches->links() }}

@stop