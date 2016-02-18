@extends('jetcms.core::layouts.master')


@section('body')
    <div class="jet-form__body">

        <div class="jet-form__row">
            <div class="jet-form__col-left">
            @section('body.left')

            @show
            </div>

            <div class="jet-form__col-center">
            @section('body.center')

            @show
            </div>

            <div class="jet-form__col-right">
            @section('body.right')

            @show
            </div>
        </div>

    </div>
@stop
