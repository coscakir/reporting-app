@extends("layouts.app")
@section('title', 'Home')
@section("content")
<h1>Dashboard</h1>

{!! Form::open(['action' => 'ReportingController@merchantLogin', 'method' => 'post']) !!}
    <div class="form-group">
    {{Form::label('email', 'E-Mail Address')}}
    {{Form::text('email', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
    {{Form::label('password', 'Password')}}
    {{Form::password('password', ['class' => 'form-control'])}}
    </div>
    <div>{{Form::submit('Login', ['class' => 'btn btn-primary'])}}</div>

   
{!! Form::close() !!}

<p class="text-muted text-center">
Email: demo@bumin.com.tr <br>
Password: cjaiU8CV</p>

@endsection