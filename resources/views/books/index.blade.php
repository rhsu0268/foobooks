@extends('layouts.master')

@section('title')
    All Books
@stop

@section('content')

    <h1>All Books</h1>

        @foreach($books as $book)
            <div>
                <h2> {{ $book->title }} </h2>
                <img src='{{ $book->cover }}'>
            </div>
        @endforeach
@stop
