@extends('layouts.master')

@section('title')
    All Books
@stop

@section('content')

    <h1>All Books</h1>

    @if(sizeof($books) == 0)
        You don't have any books yet, <a href='/books/create'>why not add one?</a>
    @else
        @foreach($books as $book)
            <div>
                <h2> {{ $book->title }} </h2>
                  <a href='/books/edit/{{$book->id}}'>Edit</a>
                  <br>
                  <img src='{{ $book->cover }}'>
            </div>
        @endforeach
    @endif
@stop
