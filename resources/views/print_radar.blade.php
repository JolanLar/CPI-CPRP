<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Impression_radar</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row principal">

        <div class="col-lg-6 offset-lg-3 rad" id="radar">
            {!! $radar->container() !!}
            {!! $radar->script() !!}
        </div>

    </div>
</div>
</body>
</html>

