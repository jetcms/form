@extends('jetcms.form::layouts.master')

@section('body.center')
<div class="jet-form__form">
    <div class="jet-form__head">
        @section('form.head')
            <h1>{{$title}}</h1>
            <p>{{$description}}</p>
        @show
    </div>

    <form action="" method="POST">

        @foreach($input as $val)
            <div class="group @if($val['error']) error @endif">
                {!! $val !!}
            </div>
        @endforeach

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div>
            <button type="submit" >Отправить</button>
        </div>

    </form>
</div>
@stop