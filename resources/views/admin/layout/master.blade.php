<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->  
    <link href="{{asset('assets/src/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="{{asset('assets/demo/default/media/img/logo/favicon.ico')}}" />
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        @include('admin.layout.topbar')
        <!-- end: header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- side menu -->
            @include('admin.layout.side')
        </div>
        <!-- BEGIN:isi -->
        @yield('content')
        <!-- END:isi -->
    </div>	
    @include('admin.layout.footer')
    <!--begin::Base Scripts -->
    <script src="{{asset('assets/src/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
    <!--end::Base Scripts -->   
    <!--begin::Page Vendors -->
    <!--end::Page Vendors -->  
    <!-- scrip alert logout -->
    <script src="{{asset('assets/js/log_outalert.js')}}" type="text/javascript"></script>
    <!--begin::Page Snippets -->
    <!--end::Page Snippets -->
    <script src="{{asset('assets/demo/default/custom/components/base/toastr.js')}}" type="text/javascript"></script>
    @yield('script')
    @if ($errors->any())
    @foreach ($errors->all() as $item)
    <script type="text/javascript">
        toastr.error("{{$item}}");
    </script>
    @endforeach
    @endif
    <script src="{{asset('assets/js/component/number.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        function formatRupiah(angka, prefix){
            var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
        
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
</body>
</html>