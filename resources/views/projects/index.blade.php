@extends('layout')

@section('content')
    <h1>Proejcts list </h1>

    @foreach($projects as $project)
        Title: {{ $project->title }}<br/>
        Description: {{ $project->description }}<br/>

    @endforeach
@endsection