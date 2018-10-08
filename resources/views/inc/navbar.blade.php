        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Dashboard</a>
                </li>
                <li class="nav-item {{ Request::is('transactions') ? 'active' : '' }}">
                    <a class="nav-link" href="/transactions">Transaction List</a>
                </li>
                </ul>
                {!! Form::open(['action' => 'ReportingController@getTransactionDetail', 'method' => 'get', 'class' => 'form-inline my-2 my-lg-0']) !!}
                    {{Form::text('transactionId', '', ['class' => 'form-control mr-sm-2', 'placeholder' => 'Transaction ID'])}}
                    {{Form::submit('Search', ['class' => 'btn btn-primary my-2 my-sm-0'])}}
                {!! Form::close() !!}
                </form>
            </div>
        </nav>
