@extends('jetcms.core::layouts.email')

@section('body')
<!-- content -->
<div class="content">
    <table>
        <tr>
            <td>
                <h1>{{$title}}</h1>
                <p class="lead">{{$description}}</p>

                <h4>Дынные формы</h4>
                @foreach($value as $val)
                    <p>{{$val['lable']}}: <strong>{{$val['value']}}</strong></p>
                @endforeach

            </td>
        </tr>
    </table>
</div><!-- /content -->
@stop