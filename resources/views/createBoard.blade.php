@extends('layouts.app')
@section('title', 'Задание 6 - создание записи')

@section('menu')

@section('content')
    <form action="/formResult">
        <p>Название записи: <input type="text" name="title"></p>
        <p>Описание записи: <textarea name="description" id="" cols="30" rows="10">
        </textarea></p>
        <p>Стоимость: <input type="text" name="price"></p>
        <p> Контакты: <input type="text" name="contact"></p>
    </form>
@endsection