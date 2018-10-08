<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporting App</title>
    <meta name="description" content="Payment service provider reporting web application.">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <header>
        @include("inc.navbar")
    </header>

    <main role="main" class="container">
       @include("inc.messages")
        @yield("content")
    </main>
    
    <footer class="footer">
        <div class="container">
            <span class="text-muted">© powered by larevel & bootstrap</span>
        </div>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>