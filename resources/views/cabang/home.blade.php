@extends('cabang.layout.master')
@section('title','Dashboard | Sistem Informasi Pamsimas')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Blog-->
                <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    Pamsimas {{ucfirst(strtolower($user->nama_cabang))}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget28">
                            <div class="m-widget28__pic m-portlet-fit--sides"></div>
                            <div class="m-widget28__container">
                                <!-- begin::Nav pills -->
                                <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" href="/cabang/bayar_tagihan">
                                            <span>
                                                <i class="fa flaticon-clock-2"></i>
                                            </span>
                                            <span>
                                                Bayar Tagihan
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" href="/cabang/input_tagihan">
                                            <span>
                                                <i class="fa flaticon-download"></i>
                                            </span>
                                            <span>
                                                Input Tagihan
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" href="/cabang/pelanggan">
                                            <span>
                                                <i class="fa flaticon-user-add"></i>
                                            </span>
                                            <span>
                                                Tambah Pelanggan
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- end::Nav pills --> 
                                <!-- begin::Tab Content -->
                                <div class="m-widget28__tab tab-content">
                                    <div id="menu11" class="m-widget28__tab-container tab-pane active">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Tanggal Dibuat
                                                </span>
                                                <span>
                                                    {{$user->created_at}}
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Nomor ID
                                                </span>
                                                <span>
                                                    {{$user->id}}
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Admin
                                                </span>
                                                <span>
                                                    {{$user->id_admin}}
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Jumlah Pelanggan
                                                </span>
                                                <span>
                                                    {{$jml}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu21" class="m-widget28__tab-container tab-pane fade">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Project Description
                                                </span>
                                                <span>
                                                    Back-End Web Architecture
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Total Charges
                                                </span>
                                                <span>
                                                    USD 2,170.000
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    INE Number
                                                </span>
                                                <span>
                                                    D110-1234562546
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Company Name
                                                </span>
                                                <span>
                                                    SLT Back-end Solutions
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu31" class="m-widget28__tab-container tab-pane fade">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Total Charges
                                                </span>
                                                <span>
                                                    USD 3,450.000
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Project Description
                                                </span>
                                                <span>
                                                    Creating Back-end Components
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Company Name
                                                </span>
                                                <span>
                                                    SLT Back-end Solutions
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    INE Number
                                                </span>
                                                <span>
                                                    D510-7431562548
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end::Tab Content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Blog-->
            </div>
            {{-- grafik --}}
            <div class="col-xl-8">
                <div class="col-xl-12">
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
                                <div class="m-stack__item m-stack__item--center m-stack__item--middle m-stack__item--fluid">
                                    <div id="chart_div"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Penggunaan Air Terbanyak
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body"  id="m_pelanggan_content">
                                <div class="m-stack m-stack--ver m-stack--general">
                                    <div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                        <div id="pie_div"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
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
                                                <a class="nav-link" href="/cabang/profil">
                                                    <span>
                                                        <i class="fa flaticon-user"></i>
                                                    </span>
                                                    <span>
                                                        Ubah Profil
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-widget28__nav-item nav-item">
                                                <a class="nav-link" href="/cabang/input_tagihan">
                                                    <span>
                                                        <i class="fa flaticon-interface-3"></i>
                                                    </span>
                                                    <span>
                                                        Set Tarif / Kebijakan
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-widget28__nav-item nav-item">
                                                <a class="nav-link" href="/cabang/pembukuan">
                                                    <span>
                                                        <i class="fa flaticon-coins"></i>
                                                    </span>
                                                    <span>
                                                        Tambah Pembukuan
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-widget28__nav-item nav-item">
                                                <a class="nav-link" href="/cabang/riwayat_tagihan">
                                                    <span>
                                                        <i class="fa flaticon-list"></i>
                                                    </span>
                                                    <span>
                                                        Riwayat Pembayaran
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <!--Begin::Portlet-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Tagihan belum terbayar
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body"  id="m_pelanggan_content">
                        <!-- begin: Datatable -->
                        <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                            <table class="m-datatable__table" id="html_table" width="100%" style="display: block; min-height: 300px; overflow-x: auto;">
                                <thead class="m-datatable__head">
                                    <tr class="m-datatable__row" style="left: 0px;">
                                        <th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
                                            No.
                                        </span></th>
                                        <th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                            Bulan
                                        </span></th>
                                        <th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
                                            Id Pelanggan
                                        </span></th>
                                        <th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 200px;">
                                            Nama Pelanggan
                                        </span></th>
                                        <th title="Field #5" class="m-datatable__cell m-datatable__cell--sort"><span>
                                            Jumlah Tagihan
                                        </span></th>
                                    </tr>
                                </thead>
                                <tbody class="m-datatable__body" id="show_data"></tbody>
                            </table>
                            {{-- Begin: action table --}}
                            <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
                                <ul class="m-datatable__pager-nav" id="nav-pagetable">
                                </ul>
                                <div class="m-datatable__pager-info" id="jumlah_baris">
                                </div>
                            </div>
                            {{-- End: action table --}}
                        </div>
                        <!--end: Datatable -->
                        <br/><br/>
                    </div>
                </div>
                <!--End::Portlet-->
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
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
      tbl.addColumn('string', 'Pelanggan');
      tbl.addColumn('number', 'Tagihan');
      $.ajax({
                  type  		: 'GET',
                  url   		: `{{url('/cabang/getdashboardtagihan')}}`,
                  async 		: true,
                  dataType 	: 'json',
                  success : function(data){
                      for(i=0;i<Object.keys(data).length;i++){
                          tbl.addRows([[data[i].nama, data[i].jml]]);
                      }
                      // Instantiate and draw our chart, passing in some options.
                      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                      chart.draw(tbl, options);
                  }
              });
  
      // Set chart options
      var options = {'title':'Tagihan terbanyak',
                      'width':$('#chart_div').width(),
                      'height':$('#chart_div').height()
                  };
  
      mApp.unblock("#chart_div");
    }
  
    function pieChart() {
  
          // Create the data table.
          var tbl = new google.visualization.DataTable();
          tbl.addColumn('string', 'Pelanggan');
          tbl.addColumn('number', 'meter air');
          $.ajax({
                  type  		: 'GET',
                  url   		: `{{url('/cabang/getdashboardmeter')}}`,
                  async 		: true,
                  dataType 	: 'json',
                  success : function(data){
                      for(i=0;i<Object.keys(data).length;i++){
                          tbl.addRows([[data[i].nama, data[i].jml]]);
                      }
                      // Instantiate and draw our chart, passing in some options.
                      var chart = new google.visualization.PieChart(document.getElementById('pie_div'));
                      chart.draw(tbl, options);
                  }
              });
  
          // Set chart options
          var options = {
              'title':'Jumlah Penggunaan Air Pelanggan bulan ini',
              'width':$('#pie_div').width(),
              'height':$('#pie_div').height()
          };
          mApp.unblock("#pie_div");
      }
</script>
<script type="text/javascript" src="{{asset('assets/js/bulan.js')}}"></script>
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_pelanggan(`{{url('/cabang/get_bayartagihanbelum?page=')}}`);   //pemanggilan fungsi tampil barang.
        
        // $('#html_table').mDatatable();
        
        // fungsi tampil barang
        function tampil_pelanggan(page){
            mApp.block("#html_table",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            $.ajax({
                pageLength  : 5,
                serverSide  : true,
                processing  : true,
                type  		: 'GET',
                url   		: page,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var html = '';
                    var jum = '';
                    var nav = '';
                    var i;
                    if(data.data.length==0){
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{
                        for(i=0; i<data.data.length; i++){
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2">'+
                                            '<span class="m-badge m-badge--success m-badge--wide" style="width: 100px;">'+echoBulan(data.data[i].bulan)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell m--font-transform-u">'+
                                            '<span style="width: 180px;">'+data.data[i].id_pelanggan+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span style="width: 170px;">'+data.data[i].nama+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" style="text-align:left">'+
                                            '<span class="m-badge m-badge--danger" >'+data.data[i].jml+'</span>'+
                                        '</td>'+
                                    '</tr>';
                        }
                    }
                    $('#show_data').html(html);
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' pelanggan</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/cabang/get_bayartagihanbelum?page=')}}";
                    for(i=0;i<data.last_page;i++){
                        var aktif = '';
                        if(i==data.current_page-1){
                            aktif= 'm-datatable__pager-link--active';
                        }
                        no_page += '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+url+(i+1)+'`)"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
                    }
                    var prev = '';
                    if(data.prev_page_url==null){
                        prev = url+1;
                    }else{
                        prev = data.prev_page_url;
                    }
                    var next = '';
                    if(data.next_page_url==null){
                        next = url+1;
                    }else{
                        next = data.next_page_url;
                    }
                    $('#jumlah_baris').html(jum);
                    nav += '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+data.first_page_url+'`)" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                                '<i class="la la-angle-double-left"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+prev+'`)"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                                '<i class="la la-angle-left"></i></a>'+
                            '</li>'+
                            '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                                '<i class="la la-ellipsis-h"></i></a>'+
                            '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
                    nex +=  '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+next+'`)" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                                '<i class="la la-angle-right"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="tampil_pelanggan(`'+data.last_page_url+'`)"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                                '<i class="la la-angle-double-right"></i></a>'+
                            '</li>'
                    $('#nav-pagetable').html(nav+no_page+nex);
                    mApp.unblock("#html_table");      
                }
            });
        }
    // });
</script>
@endsection