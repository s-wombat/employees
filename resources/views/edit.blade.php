<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
{{--{{ dd($user) }}--}}
{{--@extends('layouts.layout')--}}
{{--@section('content')--}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            @if(isset($user))
                                Редактирование пользователя {{$user->name}}
                            @else
                                Создание пользователя
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"
                              @if(isset($user))
                              action="{{route('admin.store',['id'=>$user->id])}}"
                              @else
                              action="{{route('admin.store')}}"
                                @endif
                        >
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="@if(isset($user)){{$user->name}}@endif" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="@if(isset($user)){{$user->surname}}@endif" autofocus>
                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="@if(isset($user)){{$user->email}}@endif" autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="@if(isset($user)){{$user->position}}@endif" autofocus>
                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="boss" class="col-md-4 col-form-label text-md-right">{{ __('Boss') }}</label>
                                <div class="col-md-6">
                                        <p> <select size="1" name="bosses">
                                                <option @if(isset($user) && $user->paretn_id == 0) selected @endif value="0">gen. director</option>
                                                <option @if(isset($user) && $user->paretn_id == 1) selected @endif value="1">first dir</option>
                                                <option @if(isset($user) && $user->paretn_id == 2) selected @endif value="2">second dir</option>
                                                <option @if(isset($user) && $user->paretn_id == 3) selected @endif value="3">third dir</option>
                                                <option @if(isset($user) && $user->paretn_id == 4) selected @endif value="4">dir</option>
                                                <option @if(isset($user) && $user->paretn_id == 5) selected @endif value="5">first manager</option>
                                                <option @if(isset($user) && $user->paretn_id == 6) selected @endif value="6">second manager</option>
                                                <option @if(isset($user) && $user->paretn_id == 7) selected @endif value="7">third manager</option>
                                                <option @if(isset($user) && $user->paretn_id == 8) selected @endif value="8">top manager</option>
                                                <option @if(isset($user) && $user->paretn_id == 9) selected @endif value="9">manager</option>
                                                <option @if(isset($user) && $user->paretn_id == 10) selected @endif value="10">sheff</option>
                                            </select></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="employment_date" class="col-md-4 col-form-label text-md-right">{{ __('Employment_date') }}</label>
                                <div class="col-md-6">
                                    <input id="employment_date" type="text" class="form-control{{ $errors->has('employment_date') ? ' is-invalid' : '' }}" name="employment_date" value="@if(isset($user)){{$user->employment_date}}@endif" autofocus>
                                    @if ($errors->has('employment_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employment_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                <div class="col-md-6">
                                    <input id="img" type="file" class="form-control" name="photo" >
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Сохранить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <a href="{{route('admin.filter')}}">Список пользователей</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--@endsection--}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
{{--<style>--}}
    {{--/* внешние границы таблицы серого цвета толщиной 1px */--}}
    {{--table {--}}
        {{--border: 1px solid grey;--}}
    {{--}--}}
    {{--/* границы ячеек первого ряда таблицы */--}}
    {{--th {--}}
        {{--border: 1px solid grey;--}}
        {{--padding: 10px;--}}
    {{--}--}}
    {{--/* границы ячеек тела таблицы */--}}
    {{--td {--}}
        {{--border: 1px solid grey;--}}
        {{--padding: 5px 7px;--}}
    {{--}--}}
{{--</style>--}}
</body>
</html>