@extends("layouts.app")
@section('title', 'Transaction Detail')
@section("content")
<h1>Transaction Detail</h1>
<table class="table table-striped">
    <tbody>
        <?php
        function transactionDetail($array, $level = 1){
            foreach($array as $key => $value){
                if(is_array($value)){
                    transactionDetail($value, $level + 1);
                } else{
                    echo '<tr><th scope="row">'.$key.'</th><td>'.$value.'</td></tr>';
                }
            }
        }
        transactionDetail($transaction);
        ?>
    </tbody>
</table>
@endsection