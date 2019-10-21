<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  {{--  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">  --}}
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Clinic Portal
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
  {{--  <!-- CSS Just for demo purpose, dont include it in your project -->  --}}
  <link href="{{ asset('demo/demo.css" rel="stylesheet') }}" />
</head>

<body class="">
  <div id="app">
    <App :user="{{ json_encode(Auth::user()) }}"/>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
