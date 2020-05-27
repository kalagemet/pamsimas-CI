@extends('admin.layout.master')

@section('title','Dashboard admin | Sistem Informasi Pamsimas')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Dashboard Admin
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body"  id="m_pelanggan_content">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--center m-stack__item--middle" style="width: 400px;">
                        <div id="pie_div"></div>
                    </div>
                    <div class="m-stack__item m-stack__item--center m-stack__item--middle m-stack__item--fluid">
                        <div id="chart_div"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Blog-->
                <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    Tombol Cepat
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget28">
                            <div class="m-widget28__pic m-portlet-fit--sides"></div>
                            <div class="m-widget28__container">
                                <!-- begin::Nav pills -->
                                <ul class="m-widget28__nav-items nav nav-pills nav-fill">
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" href="/admin/profil_ubah">
                                            <span>
                                                <i class="fa flaticon-user"></i>
                                            </span>
                                            <span>
                                                Ubah Profil
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" href="/admin/profil_ubah">
                                            <span>
                                                <i class="fa flaticon-map-location"></i>
                                            </span>
                                            <span>
                                                Ubah Lokasi
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" href="/admin/daftar_cabang">
                                            <span>
                                                <i class="fa flaticon-map"></i>
                                            </span>
                                            <span>
                                                Tambah Cabang
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- end::Nav pills --> 
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Blog-->
            </div>
            <div class="col-xl-8">
                <!--Begin::Portlet-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Aktifitas terakhir
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div id="isi_riwayat" class="m-portlet__body">
                        <div class="tab-content">
                            <!--Begin::Timeline 3 -->
                            <div class="m-timeline-3">
                                <div id="riwayat" class="m-timeline-3__items">
                                    <div class="m-timeline-3__item m-timeline-3__item--info">
                                        <span class="m-timeline-3__item-time m--font-focus">
                                            <h6><small><div id="riwayat1"></div></small></h6>
                                        </span>
                                        <div class="m-timeline-3__item-desc">
                                            <span class="m-timeline-3__item-text">
                                                <div id="riwayat2"></div>
                                            </span>
                                            <span class="m-timeline-3__item-user-name">
                                                <a href="#" class="m-link m-link--metal m-timeline-3__item-link">
                                                    <div id="riwayat3"></div>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End::Timeline 3 -->
                        </div>
                    </div>
                </div>
                <!--End::Portlet-->
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!--Load the AJAX API-->
<script type="text/javascript" src="{{asset('assets/js/google/loader.js')}}"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

    mApp.block("#chart_div",{
        overlayColor:"#000000",type:"loader",state:"success"
    });
    mApp.block("#pie_div",{
        overlayColor:"#000000",type:"loader",state:"success"
    });
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(pieChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    // Create the data table.
    var tbl = new google.visualization.DataTable();
    tbl.addColumn('string', 'Cabang');
    tbl.addColumn('number', 'meter air');
    $.ajax({
                type  		: 'GET',
                url   		: `{{url('/admin/getdashboardmeter')}}`,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    for(i=0;i<Object.keys(data).length;i++){
                        tbl.addRows([[data[i].nama_cabang, data[i].jml]]);
                    }
                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                    chart.draw(tbl, options);
                }
            });

    // Set chart options
    var options = {'title':'Penggunaan Air pada Cabang Bulan ini',
                    'width':$('#chart_div').width(),
                    'height':$('#chart_div').height()
                };

    mApp.unblock("#chart_div");
  }

  function pieChart() {

        // Create the data table.
        var tbl = new google.visualization.DataTable();
        tbl.addColumn('string', 'Cabang');
        tbl.addColumn('number', 'Pelanggana');
        $.ajax({
                type  		: 'GET',
                url   		: `{{url('/admin/getdashboardjumlah')}}`,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    for(i=0;i<Object.keys(data).length;i++){
                        tbl.addRows([[data[i].nama_cabang, data[i].jml]]);
                    }
                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('pie_div'));
                    chart.draw(tbl, options);
                }
            });

        // Set chart options
        var options = {
            'title':'Jumlah Pelanggan pada Cabang Bulan ini',
            'width':$('#pie_div').width(),
            'height':$('#pie_div').height()
        };
        mApp.unblock("#pie_div");
    }
</script>
<script type="text/javascript">
    riwayat();
    function riwayat(){
        mApp.block("#isi_riwayat",{
            overlayColor:"#000000",type:"loader",state:"success"
        });
        $.ajax({
                type  		: 'GET',
                url   		: `{{url('/admin/getdashboardriwayat')}}`,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var html='';
                    if(Object.keys(data).length!=0){
                        for(i=0;i<Object.keys(data).length;i++){
                            html += '<div id="riwayat" class="m-timeline-3__items"><div class="m-timeline-3__item m-timeline-3__item--info">'+
                                        '<span class="m-timeline-3__item-time m--font-focus">'+
                                            '<h6><small><div>'+data[i].created_at+'</div></small></h6>'+
                                        '</span>'+
                                        '<div class="m-timeline-3__item-desc">'+
                                            '<span class="m-timeline-3__item-text">'+
                                                '<div>'+data[i].keterangan+'</div>'+
                                            '</span>'+
                                            '<span class="m-timeline-3__item-user-name">'+
                                                '<a class="m-link m-link--metal m-timeline-3__item-link">'+
                                                    '<div>'+'by '+data[i].nama_cabang+'</div>'+
                                               ' </a>'+
                                            '</span>'+
                                        '</div>'+
                                    '</div></div>';
                        }
                    }
                    else{
                        html += '<div id="riwayat" class="m-timeline-3__items"><div class="m-timeline-3__item m-timeline-3__item--info">'+
                                        '<span class="m-timeline-3__item-time m--font-focus">'+
                                            '<h6><small><div>00-00</div></small></h6>'+
                                        '</span>'+
                                        '<div class="m-timeline-3__item-desc">'+
                                            '<span class="m-timeline-3__item-text">'+
                                                '<div>Tidak ada aktifitas terkini</div>'+
                                            '</span>'+
                                            '<span class="m-timeline-3__item-user-name">'+
                                                '<a class="m-link m-link--metal m-timeline-3__item-link">'+
                                                    '<div>by Sistem</div>'+
                                               ' </a>'+
                                            '</span>'+
                                        '</div>'+
                                    '</div></div>';
                    }
                    $('#riwayat').html(html);
                    mApp.unblock("#isi_riwayat");
                }
            });
    }
</script>
@endsection
