@extends('layout')

@section('title', 'Create Task')

@section('content')
    <div class="px-64">
        <h1 class="font-bold text-3xl">Create Task</h1>
        <form action="/tasks" method="POST">
            @csrf
            <label class="block" for="title">Title</label>
            <input class="border border-gray-800 w-full" type="text" name="title" id="title" />

            <label class="block" for="body">Body</label>
            <textarea class="border border-gray-800 w-full" name="body" id="body" cols="30" rows="10"></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 float-right">Submit</button>
        </form>
    </div>
@endsection