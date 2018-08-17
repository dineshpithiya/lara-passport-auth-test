<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}">
    <script type="text/javascript" src="{{URL::asset('nprogress/nprogress.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('nprogress/nprogress.css')}}">
    
    <script type="text/javascript" src="{{URL::asset('js/form-submit.js')}}"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard <a href="{{URL('logout')}}" class="pull-right">Logout</a></div>
                    <div class="panel-body">
                        <table border="1" width="100%">
                            <tr>
                                <td>Id</td>
                                <td>Name</td>
                                <td>Email</td>
                            </tr>
                            @foreach ($user as $key=>$value)
                                <tr>
                                    <td>{{$key=$key+1}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                </tr>
                            @endforeach    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>