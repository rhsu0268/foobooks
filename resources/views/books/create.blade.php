@extends('layouts.master')

{{-- define a section called title
 show book 
 --}}
@section('title')
    Create Book
@stop

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')
    <link href="/css/books/create.css" type='text/css' rel='stylesheet'>
@stop


@section('content')
	<form method="POST" action="/books/create">
	    <input type="text" name="title">
	    <input type="submit">
    <form>
@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
    <script src="/js/books/create.js"></script>
@stop

