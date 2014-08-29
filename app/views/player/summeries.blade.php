@extends('default.layout')

@section('header')
	<h1> {{ $player->profile->personaname }} </h1>

	<img src="{{ $player->profile->avatarmedium }}"/>
	
	<p>Link to <a href="{{ $player->profile->profileurl }}">profile!</a></p>
@stop

@section('content')
	<h1>Matches!</h1>
<table>
	<tr>
		<th>Hero |</th>
		<th>Level |</th>
		<th>Kills |</th>
		<th>Deaths |</th>
		<th>Assists |</th>
		<th>Last hits |</th>
		<th>Denies |</th>
		<th>Gold per min |</th>
		<th>Xp per min</th>
	</tr>
	@foreach($player->matches as $match)
		<tr>
			<td> {{ $match->hero_id }} </td>
			<td> {{ $match->level }} </td>
			<td> {{ $match->kills }} </td>
			<td> {{ $match->deaths }} </td>
			<td> {{ $match->assists }} </td>
			<td> {{ $match->last_hits }} </td>
			<td> {{ $match->denies }} </td>
			<td> {{ $match->gold_per_min }} </td>
			<td> {{ $match->xp_per_min }} </td>
		</tr>
	@endforeach
</table>
@stop