<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

{{--@extends('layouts.layout')--}}
{{--@section('content')--}}
<div class="row">
<div class="col-md-1"></div>
    <div class="col-md-10">

    <div class="alert alert-secondary" role="alert">
        Список пользователей --------------------- <a href="{{ url('/') }}">Главная страница</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('admin.sort')}}" method="get">
                <p>Сортировать по значению: <select size="1" name="users_sort">
                        <option @if(request()->get('users_sort') == 'id') selected @endif value="id">id</option>
                        <option @if(request()->get('users_sort') == 'parent_id') selected @endif value ="parent_id">boss</option>
                        <option @if(request()->get('users_sort') == 'name') selected @endif value ="name">name</option>
                        <option @if(request()->get('users_sort') == 'surname') selected @endif value ="surname">surname</option>
                        <option @if(request()->get('users_sort') == 'email') selected @endif value ="email">email</option>
                        <option @if(request()->get('users_sort') == 'position') selected @endif value ="position">position</option>
                        <option @if(request()->get('users_sort') == 'employment_date') selected @endif value ="employment_date">employment_date</option>
                    </select></p>
                <p><input type="hidden" name="_method" value="sort" />
                    <input type="submit" value="Сортировать" /></p>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('admin.create') }}" method="get">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="create">
                <input type="submit" value="Создать нового пользователя">

            </form>
        </div>
    </div>
        <div>
            <p>Поиск сотрудников:</p>
            <form class="filter" action="{{ route('admin.filter') }}" method="get">
                <input type="text" id="search_name" placeholder="name" name="name" value="{{ request()->get('name') }}">
                <input type="text" id="search_surname" placeholder="surname" name="surname" value="{{ request()->get('surname') }}">
                <input type="text" id="search_email" placeholder="email" name="email" value="{{ request()->get('email') }}">
                <input type="text" id="search_position" placeholder="position" name="position" value="{{ request()->get('position') }}">
                <input type="text" id="search_employment_date" placeholder="employment_date" name="employment_date" value="{{ request()->get('employment_date') }}">
                <input type="submit" value="filter" name="submit">
            </form>
        </div>

    <table id="users">
        <thead>
        <tr>
            <th>id</th>
            <th>Boss</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Почта</th>
            <th>Должность</th>
            <th>Дата приема на работу</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    @if($user->parent_id == 0)
                        {{ $user->name }}
                    @else
                        {{ $user->parent['name'] }}
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->position }}</td>
                <td>{{ $user->employment_date }}</td>
                <td>
                    <form action="{{route('admin.edit', ['id'=>$user->id])}}" method="get">
                        {{--{{ csrf_field() }}--}}
                        <input type="hidden" name="_method" value="edit" />
                        <input type="submit" value="Редактировать" />
                    </form>
                </td>
                <td>
                    <form action="{{route('admin.remove', ['id'=>$user->id])}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="submit" value="Удалить" />
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{ $users->appends(request()->except('page'))->links() }}
    </div>
    <div class="col-md-1">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
{{--@endsection--}}
<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>
    /* внешние границы таблицы серого цвета толщиной 1px */
    table {
        border: 1px solid grey;
    }
    /* границы ячеек первого ряда таблицы */
    th {
        border: 1px solid grey;
        padding: 10px;
    }
    /* границы ячеек тела таблицы */
    td {
        border: 1px solid grey;
        padding: 5px 7px;
    }
</style>
<script type="text/javascript">
    window.onload = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#search_name').keyup(function() {
            $.ajax({
                method: "GET",
                url: "search",
                data: {
                    name: $('#search_name').val(),
                    surname: $('#search_surname').val(),
                    email: $('#search_email').val(),
                    position: $('#search_position').val(),
                    employment_date: $('#search_employment_date').val(),
                }
            })
                .done(function() {
                    // console.log( data );
                    $('#users tbody tr').remove();
                    var html = '';
                    $.each(data, function( value ) {
                        console.log( value.id, value.parent_id, value.name, value.surname, value.email, value.position, value.employment_date );
                        html += '<tr><td>'+value.id+'</td><td>'+value.parent_id+'</td><td>'+value.name+'</td>' +
                            '<td>'+value.surname+'</td><td>'+value.email+'</td><td>'+value.position+'</td><td>'+value.employment_date+'</td></tr>'
                        $('#users tdody').append(html);
                    });
                })
                .fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });
        });



    }
</script>
</body>
</html>
