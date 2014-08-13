@extends('default.master')

@section('content')
	<h2> {{ $player->name }} </h2>
	<li> {{ $player->gold_per_min }} </li>
@stop