<html lang="en">
<head>
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="css/app.css">
    <title>Laravel 5.3 with Vuejs</title>
</head>
<body>



<div  id="app">
    <tasks></tasks>
</div>


</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>