@if (\Cookie::get('token') !== null)
<script type="text/javascript">
    window.location = "{{ url('/dashboard') }}";
</script>
@endif
@extends("layouts.app")
@section('title', 'Merchant Login')
@section("content")
<h1>Merchant Login</h1>

{!! Form::open(['action' => 'ReportingController@merchantLogin', 'method' => 'post', 'class' => 'form-signin']) !!}
    <div class="form-group">
    {{Form::label('email', 'E-Mail Address')}}
    {{Form::text('email', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
    {{Form::label('password', 'Password')}}
    {{Form::password('password', ['class' => 'form-control'])}}
    </div>
    <div>{{Form::submit('Login', ['class' => 'btn btn-lg btn-primary btn-block'])}}</div>

   
{!! Form::close() !!}

<p class="text-muted text-center">
<strong>Email:</strong> demo@bumin.com.tr <br>
<strong>Password:</strong> cjaiU8CV
</p>

@endsection