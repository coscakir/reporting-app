@extends("layouts.app")
@section("content")
<h1>Transactions</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Merchant</th>
            <th scope="col">Status</th>
            <th scope="col">Amount</th>
            <th scope="col">Type</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = $transactions["from"] ?>
        @foreach($transactions["data"] as $row)
            @if(isset($row["transaction"]) && isset($row["customerInfo"]) && isset($row["merchant"]) && isset($row["fx"]) && isset($row["acquirer"]))
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td><a title="view customer detail" href="/client?transactionId={{ $row['transaction']['merchant']['transactionId'] }}">{{ $row["customerInfo"]["billingFirstName"].' '.$row["customerInfo"]["billingLastName"] }}</a></td>
                    <td>{{$row["merchant"]["name"]}}</td>
                    <td>{{$row["transaction"]["merchant"]["status"]}}</td>
                    <td>{{$row["fx"]["merchant"]["originalAmount"].' '.$row["fx"]["merchant"]["originalCurrency"]}}</td>
                    <td>{{$row["acquirer"]["type"]}}</td>
                    <td>{{$row["transaction"]["merchant"]["created_at"]}}</td>
                    <td><a href="/transaction?transactionId={{ $row['transaction']['merchant']['transactionId'] }}">Transaction Detail</a></td>
                </tr>
                <?php $i++ ?>
            @endif
        @endforeach
    </tbody>
</table>


<nav class="page-nav" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item {{ $transactions['prev_page_url'] == null ? 'disabled' : '' }}"><a class="page-link" href="/transactions?page={{ $transactions['current_page']-1 }}">Previous</a></li>
        <li class="page-item {{ $transactions['next_page_url'] == null ? 'disabled' : '' }}"><a class="page-link" href="/transactions?page={{ $transactions['current_page']+1 }}">Next</a></li>
    </ul>
</nav>
@endsection