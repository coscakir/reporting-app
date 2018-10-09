@if (\Cookie::get('token') === null)
<script type="text/javascript">
    window.location = "{{ url('/') }}";
</script>
@endif
@extends("layouts.app")
@section('title', 'Client Detail')
@section("content")
<h1>Client Detail</h1>
<div class="card">
    <table class="table table-striped">
        <tbody>
            <?php
            function clientDetail($array, $level = 1){
                foreach($array as $key => $value){
                    if(is_array($value)){
                        clientDetail($value, $level + 1);
                    } else{
                        echo '<tr><th scope="row">'.$key.'</th><td>'.$value.'</td></tr>';
                    }
                }
            }
            clientDetail($client);
            ?>
        </tbody>
    </table>
</div>
@endsection