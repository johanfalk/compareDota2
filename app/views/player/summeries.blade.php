@extends('default.layout')

@section('main-menu')
	<h2>Compare Dota 2</h2>

	<ul>
		<li><a href="#">Start</a></li>
		<li><a href="#">Summeries</a></li>
		<li><a href="#">Heroes</a></li>
	</ul>
@stop

@section('header')
	<h1> {{ $player->name }} </h1>

	<a href="{{ $player->profileUrl }}">
		<img src="{{ $player->avatar }}"/>
	</a>
@stop

@section('top-content')

	<h2>Average Stats</h2>

	<section class="avegrage-player-stats {{ $player->IDs->steam64ID }}">
		<div><p>Kill/Death Ratio: {{ $player->stats->KD }}</p></div>
		<div><p>Kill/Death/Assist Ratio: {{ $player->stats->KDA }}</p></div>
		<div><p>Kills: {{ $player->stats->avgKills }}</p></div>
		<div><p>Deaths: {{ $player->stats->avgDeaths }}</p></div>
		<div><p>Assists: {{ $player->stats->avgAssists }}</p></div>
		<div><p>Gold Per Min: {{ $player->stats->avgGpm }}</p></div>
		<div><p>Experience Per Min: {{ $player->stats->avgXpm }}</p></div>
		<div><p>Creep Kills: {{ $player->stats->avgCreepKills }}</p></div>
		<div><p>Creep Denies: {{ $player->stats->avgCreepDenies }}</p></div>
	</section>
@stop

@section('content')
	
	<h2>Matches Played</h2>

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
@stop