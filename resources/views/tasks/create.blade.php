@extends('layout')

@section('title', 'Create Task')

@section('content')
    <h1 class="font-bold text-3xl">Create Task</h1>
    <form action="/tasks" method="POST">
        <label class="block" for="title">Title</label>
        <input class="border border-gray-800" type="text" name="title" id="title" />

        <label class="block" for="body">Body</label>
        <textarea class="border border-gray-800" name="body" id="body" cols="30" rows="10"></textarea>

        <button class="bg-blue-600">Submit</button>
    </form>
@endsection