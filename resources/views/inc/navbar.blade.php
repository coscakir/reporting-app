        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/transactions">Transaction List</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="get" action="http://localhost/bumin/public/transaction">
                <input class="form-control mr-sm-2" type="search" name="transactionId" placeholder="Transaction ID" aria-label="Transaction ID" required>
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
