@if (\Cookie::get('token') === null)
<script type="text/javascript">
    window.location = "{{ url('/') }}";
</script>
@endif
@extends("layouts.app")
@section('title', 'Dashboard')
@section("content")
<h1>Welcome to Dashboard</h1>
<div class="row">
    @foreach($data["response"] as $key => $value)
        <div class="col-md-3">
            <div class="badge badge-primary">
                curency
                <br>
                <h3>{{ $value["currency"] }}</h3> 
                <br>
                transaction qty
                <br>
                <h4>{{ $value["count"] }}</h4>
                <br>
                total amount
                <br>
                <h4>{{ number_format($value["total"]) }}</h4>
            </div>
        </div>
    @endforeach
</div>
@endsection