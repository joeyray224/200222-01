@extends('layouts.app')
@section('title', 'Задание 6 - вывести все записи')
@section('content')
    @parent
    @foreach($show as $elem)
        <p>{{$elem}}</p>
    @endforeach
    {{$paginator}}
@endsection