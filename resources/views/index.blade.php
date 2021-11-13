<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>
    <title>Компания</title>
    <script>
        function conf(lnk, text){
            if(confirm(text)){
                document.location.href = lnk;
            }

            return false;
        }
    </script>
</head>
<body>

<div class="container">
    <div class="content">
        <div class="body">
            <div id="app"><app></app></div>
        </div>
    </div>
</div>
</body>
</html>