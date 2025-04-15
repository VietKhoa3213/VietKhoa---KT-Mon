<!DOCTYPE html>
<html lang="vi"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('source/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('source/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <link href="{{ asset('source/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <link href="{{ asset('source/admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('source/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('source/admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin-custom.css') }}" rel="stylesheet">  

    @yield('css')
    @stack('styles') 

    </head>

<body>

    <div id="wrapper">

        @include('admin.layout_admin.header')

        <div id="page-wrapper">
            <div class="container-fluid">
                 @yield('content')
            </div>
            </div>
        </div>
    <script src="{{ asset('source/admin/bower_components/jquery/dist/jquery.min.js') }}"></script> 

    <script src="{{ asset('source/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('source/admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <script src="{{ asset('source/admin/dist/js/sb-admin-2.js') }}"></script>

    <script src="{{ asset('source/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script> 
    <script src="{{ asset('source/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script> 
   <script src="{{ asset('source/admin/bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script> 

    @yield('js')
    @stack('scripts') 

    <script>
     $(document).ready(function() {
         $('#dataTables-example').DataTable({
                 responsive: true
         });
     });
    </script>

</body>

</html>