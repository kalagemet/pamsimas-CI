@extends('admin.layout.master')
@section('title','Pembukuan Cabang | Sistem Informasi Pamsimas')
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
                            Infografis
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
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Data Keuangan Pamsimas
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body"  id="m_pelanggan_content">
                {{-- Begin:search --}}
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <span>Cabang : </span>
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-8">
                                    <div class="m-input-icon m-input-icon--left">
                                        <select required name="cabang" id="cabang" class="form-control m-input">
                                            @foreach ($cabang as $item)
                                            <option value="{{$item->id}}">{{ucfirst(strtolower($item->nama_cabang))}}</option>
                                            @endforeach
                                        </select>
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 order-1 order-xl-1 m--align-right">
                            <span>Bulan : </span>
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-12">
                                    <div class="m-input-icon m-input-icon--left">
                                        <select required name="bulan" id="bulan" class="form-control m-input">
                                                <option selected value="0">Semua Bulan</option>
                                                @for ($bln=1; $bln <= $bulan; $bln++)
                                                    <option value="{{$bln}}">
                                                        @php 
                                                            switch($bln){
                                                                case 1:
                                                                    echo "Januari";
                                                                    break;
                                                                case 2:
                                                                    echo "Februari";
                                                                    break;
                                                                case 3:
                                                                echo "Maret";
                                                                    break;
                                                                case 4:
                                                                echo "April";
                                                                    break;
                                                                case 5:
                                                                echo "Mei";
                                                                    break;
                                                                case 6:
                                                                echo "Juni";
                                                                    break;
                                                                case 7:
                                                                echo "Juli";
                                                                    break;
                                                                case 8:
                                                                echo "Agustus";
                                                                    break;
                                                                case 9:
                                                                echo "September";
                                                                    break;
                                                                case 10:
                                                                echo "Oktober";
                                                                    break;
                                                                case 11:
                                                                echo "November";
                                                                    break;
                                                                case 12:
                                                                echo "Desember";
                                                                    break;
                                                                default:
                                                                echo "-";
                                                                    break;
                                                            }
                                                        @endphp
                                                    </option>
                                                @endfor
                                        </select>
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="fa fa-calendar-check-o"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 order-1 order-xl-1 m--align-right">
                            <span>Tahun : </span>
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-12">
                                    <div class="m-input-icon m-input-icon--left">
                                        <select required name="tahun" id="tahun" class="form-control m-input">
                                            @for ($year=$tahun_rilis; $year <= date('Y'); $year++)
                                                <option @if($year==date('Y')) selected @endif value="{{$year}}">{{$year}}</option>
                                            @endfor
                                        </select>
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="fa fa-calendar-check-o"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End:search --}}
                <!-- begin: Datatable -->
                <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                    <table class="m-datatable__table" id="html_table" width="100%" style="display: block; min-height: 300px; overflow-x: auto;">
                        <thead class="m-datatable__head">
                            <tr class="m-datatable__row" style="left: 0px;">
                                <th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
                                    No.
                                </span></th>
                                <th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
                                    Tanggal Transaksi
                                </span></th>
                                <th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                    Debet
                                </span></th>
                                <th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                    Kredit
                                </span></th>
                                <th title="Field #5" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                    Saldo
                                </span></th>
                                <th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 200px;">
                                    Keterangan
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
        {{-- //bawah --}}
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="m-portlet m-portlet--mobile">
                        <div class="m-portlet__body"  id="m_pelanggan_content1">
                            <!-- begin: Datatable -->
                            <div id="pendapatanbulan" class="m-widget29">
                                <div class="m-widget_content">
                                    <h3 class="m-widget_content-title">
                                        Pendapatan Cabang Bulan ini
                                    </h3>
                                    <div class="m-widget_content-items">
                                        <div class="m-widget_content-item">
                                            <span>
                                                Debet
                                            </span>
                                            <span class="m--font-accent">
                                                --
                                            </span>
                                        </div>
                                        <div class="m-widget_content-item">
                                            <span>
                                                Kredit
                                            </span>
                                            <span class="m--font-danger">
                                                --
                                            </span>
                                        </div>
                                        <div class="m-widget_content-item">
                                            <span>
                                                Debet (Tagihan)
                                            </span>
                                            <span class="m--font-brand">
                                                --
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="m-portlet m-portlet--mobile">
                        <div class="m-portlet__body"  id="m_pelanggan_content1">
                            <!-- begin: Datatable -->
                            <div id="pendapatantahun" class="m-widget29">
                                <div class="m-widget_content">
                                    <h3 class="m-widget_content-title">
                                        Pendapatan Cabang Tahun ini
                                    </h3>
                                    <div class="m-widget_content-items">
                                        <div class="m-widget_content-item">
                                            <span>
                                                Debet
                                            </span>
                                            <span class="m--font-accent">
                                                --
                                            </span>
                                        </div>
                                        <div class="m-widget_content-item">
                                            <span>
                                                Kredit
                                            </span>
                                            <span class="m--font-danger">
                                                --
                                            </span>
                                        </div>
                                        <div class="m-widget_content-item">
                                            <span>
                                                Debet (Tagihan)
                                            </span>
                                            <span class="m--font-brand">
                                                --
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                    <div class="m-portlet m-portlet--mobile">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Pemasukan Non Tagihan
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body"  id="m_pelanggan_content2">
                            <!-- begin: Datatable -->
                            <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                                <table class="m-datatable__table" id="html_table1" width="100%" style="display: block; min-height: 300px; overflow-x: auto;">
                                    <thead class="m-datatable__head">
                                        <tr class="m-datatable__row" style="left: 0px;">
                                            <th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
                                                No.
                                            </span></th>
                                            <th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
                                                Tanggal
                                            </span></th>
                                            <th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                                Jumlah
                                            </span></th>
                                            <th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 200px;">
                                                Keterangan
                                            </span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="m-datatable__body" id="show_data1"></tbody>
                                </table>
                                {{-- Begin: action table --}}
                                <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
                                    <ul class="m-datatable__pager-nav" id="nav-pagetable1">
                                    </ul>
                                    <div class="m-datatable__pager-info" id="jumlah_baris1">
                                    </div>
                                </div>
                                {{-- End: action table --}}
                            </div>
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Pemasukan Tagihan
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body"  id="m_pelanggan_content3">
                        <!-- begin: Datatable -->
                        <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                            <table class="m-datatable__table" id="html_table2" width="100%" style="display: block; min-height: 300px; overflow-x: auto;">
                                <thead class="m-datatable__head">
                                    <tr class="m-datatable__row" style="left: 0px;">
                                        <th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
                                            No.
                                        </span></th>
                                        <th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
                                            Tanggal
                                        </span></th>
                                        <th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                            Jumlah
                                        </span></th>
                                        <th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 200px;">
                                            Keterangan
                                        </span></th>
                                    </tr>
                                </thead>
                                <tbody class="m-datatable__body" id="show_data2"></tbody>
                            </table>
                            {{-- Begin: action table --}}
                            <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
                                <ul class="m-datatable__pager-nav" id="nav-pagetable2">
                                </ul>
                                <div class="m-datatable__pager-info" id="jumlah_baris2">
                                </div>
                            </div>
                            {{-- End: action table --}}
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Pengeluaran Cabang
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body"  id="m_pelanggan_content4">
                        <!-- begin: Datatable -->
                        <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                            <table class="m-datatable__table" id="html_table3" width="100%" style="display: block; min-height: 300px; overflow-x: auto;">
                                <thead class="m-datatable__head">
                                    <tr class="m-datatable__row" style="left: 0px;">
                                        <th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
                                            No.
                                        </span></th>
                                        <th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
                                            Tanggal
                                        </span></th>
                                        <th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                            Jumlah
                                        </span></th>
                                        <th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 200px;">
                                            Keterangan
                                        </span></th>
                                    </tr>
                                </thead>
                                <tbody class="m-datatable__body" id="show_data3"></tbody>
                            </table>
                            {{-- Begin: action table --}}
                            <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
                                <ul class="m-datatable__pager-nav" id="nav-pagetable3">
                                </ul>
                                <div class="m-datatable__pager-info" id="jumlah_baris3">
                                </div>
                            </div>
                            {{-- End: action table --}}
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Rata-Rata pengunaan air tiap bulan pada cabang (dalam Meter Air)
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body"  id="m_pelanggan_content5">
                        <div class="m-widget27 m-portlet-fit--sides">
                            <div class="m-widget27__pic">
                                <img src="{{asset('assets/src/media/app/img/bg/bg-4.jpg')}}" style="height:50%" alt="">
                                <h3 class="m-widget27__title m--font-light">
                                    <span>
                                        <div class="row" id="avg">--</div>
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/js/tanggal_helper.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_data(`{{url('/admin/getpembukuan?')}}`,{{$tahun_ini}});   //pemanggilan fungsi tampil barang.
        
        // $('#html_table').mDatatable();
        
        // fungsi tampil barang
        function tampil_data(address, thn){
            mApp.block("#html_table",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            var id = document.getElementById('cabang');
            var bulan = document.getElementById('bulan').value;
            bulan = "&bulan="+bulan;
            var page = address+'id='+id.value+'&tahun=';
            $.ajax({
                type  		: 'GET',
                url   		: page+thn+bulan,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var i;
                    var html = '';
                    if(data.data.length==0){
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{ 
                        var tmp = '-';
                        var aksi = ''; 
                        for(i=0; i<data.data.length; i++){
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 180px;">'+indonesian_date(data.data[i].created_at)+' '+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span class="m--font-success" style="width: 100px;">'+formatRupiah(data.data[i].debet,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span class="m--font-danger" style="width: 100px;">'+formatRupiah(data.data[i].kredit,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" class="m-datatable__cell">'+
                                            '<span class="m--font-primary" style="width: 100px;">'+formatRupiah(data.data[i].saldo,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 200px;">'+data.data[i].keterangan+'</span>'+
                                        '</td>'+
                                    '</tr>';  
                        }
                    }
                    $('#show_data').html(html);
                    var jum = '';
                    var nav = '';
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' Data</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/admin/getpembukuan?page=')}}";
                    for(i=0;i<data.last_page;i++){
                        var aktif = '';
                        if(i==data.current_page-1){
                            aktif= 'm-datatable__pager-link--active';
                        }
                        no_page += '<li><a href="javascript:void(0)" onclick="tampil_data(`'+url+(i+1)+'&id='+id.value+'&tahun=`,'+thn+')"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
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
                    nav += '<li><a href="javascript:void(0)" onclick="tampil_data(`'+data.first_page_url+'&id='+id.value+'&tahun=`,'+thn+')" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                                '<i class="la la-angle-double-left"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="tampil_data(`'+prev+'&id='+id.value+'&tahun=`,'+thn+')"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                                '<i class="la la-angle-left"></i></a>'+
                            '</li>'+
                            '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                                '<i class="la la-ellipsis-h"></i></a>'+
                            '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
                    nex +=  '<li><a href="javascript:void(0)" onclick="tampil_data(`'+next+'&id='+id.value+'&tahun=`,'+thn+')" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                                '<i class="la la-angle-right"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="tampil_data(`'+data.last_page_url+'&id='+id.value+'&tahun=`,'+thn+')"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                                '<i class="la la-angle-double-right"></i></a>'+
                            '</li>'
                    $('#nav-pagetable').html(nav+no_page+nex);
                    mApp.unblock("#html_table");
                }
            });
        }
    // });
</script>
<script>
    $('#tahun').on('change', function(e){
        var th = e.target.value;
        tampil_data(`{{url('/admin/getpembukuan?')}}`,th);
    });
</script>
<script>
    $('#cabang').on('change', function(e){
        var th = document.getElementById('tahun');
        google.charts.setOnLoadCallback(pieChart);
        tampil_data(`{{url('/admin/getpembukuan?')}}`,th.value);
        pendapatanBulan();
        pendapatanTahun();
        pendapatanNonTagihan(`{{url('/admin/getpendapatannontagihan?')}}`);
        pendapatanTagihan(`{{url('/admin/getpendapatantagihan?')}}`);
        pengeluaran(`{{url('/admin/getpengeluaran?')}}`);
        averages(`{{url('/admin/getavg?')}}`);
    })

    $('#bulan').on('change', function(e){
        var th = document.getElementById('tahun');
        google.charts.setOnLoadCallback(pieChart);
        tampil_data(`{{url('/admin/getpembukuan?')}}`,th.value);
        pendapatanBulan();
        pendapatanTahun();
        pendapatanNonTagihan(`{{url('/admin/getpendapatannontagihan?')}}`);
        pendapatanTagihan(`{{url('/admin/getpendapatantagihan?')}}`);
        pengeluaran(`{{url('/admin/getpengeluaran?')}}`);
        averages(`{{url('/admin/getavg?')}}`);
    })
</script>
{{-- Grafik --}}
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
      tbl.addColumn('number', 'Saldo (dalam Rp)');
      $.ajax({
                  type  		: 'GET',
                  url   		: `{{url('/admin/getdashboardsaldo')}}`,
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
      var options = {'title':'Saldo Cabang',
                      'width':$('#chart_div').width(),
                      'height':$('#chart_div').height()
                  };
  
      mApp.unblock("#chart_div");
    }
  
    function pieChart() {
        
      mApp.block("#pie_div",{
          overlayColor:"#000000",type:"loader",state:"success"
      });
          // Create the data table.
          var tbl = new google.visualization.DataTable();
          var id = document.getElementById('cabang').value;
          var bln = document.getElementById('bulan').value;
          var cabang = document.getElementById('cabang');
          var cabang = cabang.options[cabang.selectedIndex].text;
          tbl.addColumn('string', 'Kategori');
          tbl.addColumn('number', 'Jumlah');
          $.ajax({
                  type  		: 'GET',
                  url   		: `{{url('/admin/getdashboardkredit?id=')}}`+id+'&bulan='+bln,
                  async 		: true,
                  dataType 	: 'json',
                  success : function(data){
                      for(i=0;i<Object.keys(data).length;i++){
                          cabang = data[i].cabang;
                          tbl.addRows([["Debet", data[i].debet]]);
                          tbl.addRows([["Kredit", data[i].kredit]]);
                      }
                      // Instantiate and draw our chart, passing in some options.
                      var chart = new google.visualization.PieChart(document.getElementById('pie_div'));
                      chart.draw(tbl, options);
                  }
              });
  
          // Set chart options
          var options = {
              'title':'Debet Kredit pada cabang '+cabang+' (dalam Rp.)',
              'width':$('#pie_div').width(),
              'height':$('#pie_div').height()
          };
          mApp.unblock("#pie_div");
      }
</script>
{{-- widget --}}
<script type="text/javascript">
    pendapatanBulan();
    pendapatanTahun();
    pendapatanNonTagihan(`{{url('/admin/getpendapatannontagihan?')}}`);
    pendapatanTagihan(`{{url('/admin/getpendapatantagihan?')}}`);
    pengeluaran(`{{url('/admin/getpengeluaran?')}}`);
    averages(`{{url('/admin/getavg?')}}`);

    function pendapatanBulan(){
        mApp.block("#pendapatanbulan",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mengambil Data..."
        });
        var id = document.getElementById('cabang').value;
        var bulan = document.getElementById('bulan').value;
        $.ajax({
                type  		: 'GET',
                url   		: `{{url('/admin/getpendapatanbulanini?id=')}}`+id+'&bulan='+bulan,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var html = '';
                    html =      '<div id="pendapatanbulan" class="m-widget29"><div class="m-widget_content">'+
                                    '<h3 class="m-widget_content-title">'+
                                        'Pendapatan Cabang Bulan ini'+
                                    '</h3>'+
                                    '<div class="m-widget_content-items">'+
                                        '<div class="m-widget_content-item">'+
                                            '<span>Debet'+
                                            '</span>'+
                                            '<span class="m--font-accent">'
                                                +formatRupiah(data.all[0].debet, "Rp. ")+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="m-widget_content-item">'+
                                            '<span>'+
                                                'Kredit'+
                                            '</span>'+
                                            '<span class="m--font-danger">'+
                                                    formatRupiah(data.all[0].kredit, "Rp. ")+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="m-widget_content-item">'+
                                            '<span>'+
                                                'Debet (Tagihan)'+
                                            '</span>'+
                                            '<span class="m--font-brand">'+
                                                    formatRupiah(data.tagihan[0].debet, "Rp. ")+
                                            '</span>'+
                                        '</div>'+
                                    '</div>'+
                                '</div></div>';
                    $('#pendapatanbulan').html(html);
                }
        });

                                
    }
    function pendapatanTahun(){
        mApp.block("#pendapatantahun",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mengambil Data..."
        });
        var id = document.getElementById('cabang').value;
        $.ajax({
                type  		: 'GET',
                url   		: `{{url('/admin/getpendapatantahunini?id=')}}`+id,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var html = '';
                    html =      '<div id="pendapatantahun" class="m-widget29"><div class="m-widget_content">'+
                                    '<h3 class="m-widget_content-title">'+
                                        'Pendapatan Cabang Tahun ini'+
                                    '</h3>'+
                                    '<div class="m-widget_content-items">'+
                                        '<div class="m-widget_content-item">'+
                                            '<span>Debet'+
                                            '</span>'+
                                            '<span class="m--font-accent">'
                                                +formatRupiah(data.all[0].debet, "Rp. ")+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="m-widget_content-item">'+
                                            '<span>'+
                                                'Kredit'+
                                            '</span>'+
                                            '<span class="m--font-danger">'+
                                                    formatRupiah(data.all[0].kredit, "Rp. ")+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="m-widget_content-item">'+
                                            '<span>'+
                                                'Debet (Tagihan)'+
                                            '</span>'+
                                            '<span class="m--font-brand">'+
                                                    formatRupiah(data.tagihan[0].debet, "Rp. ")+
                                            '</span>'+
                                        '</div>'+
                                    '</div>'+
                                '</div></div>';
                    $('#pendapatantahun').html(html);
                }
        });

                                
    }
    function pendapatanNonTagihan(address){
        mApp.block("#m_pelanggan_content2",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mengambil Data..."
        });
        var id = document.getElementById('cabang').value;
        var bulan = document.getElementById('bulan').value;
        var page = address+'id='+id+'&bulan='+bulan;
        $.ajax({
                type  		: 'GET',
                url   		: page,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var i;
                    var html = '';
                    if(data.data.length==0){
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{ 
                        var tmp = '-';
                        var aksi = ''; 
                        for(i=0; i<data.data.length; i++){
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 180px;">'+indonesian_date(data.data[i].tgl)+' '+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span class="m--font-success" style="width: 100px;">'+formatRupiah(data.data[i].debet,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 200px;">'+data.data[i].ket+'</span>'+
                                        '</td>'+
                                    '</tr>';  
                        }
                    }
                    $('#show_data1').html(html);
                    var jum = '';
                    var nav = '';
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' Data</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/admin/getpendapatannontagihan?page=')}}";
                    for(i=0;i<data.last_page;i++){
                        var aktif = '';
                        if(i==data.current_page-1){
                            aktif= 'm-datatable__pager-link--active';
                        }
                        no_page += '<li><a href="javascript:void(0)" onclick="pendapatanNonTagihan(`'+url+(i+1)+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
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
                    $('#jumlah_baris1').html(jum);
                    nav += '<li><a href="javascript:void(0)" onclick="pendapatanNonTagihan(`'+data.first_page_url+'&id='+id+'`)" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                                '<i class="la la-angle-double-left"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="pendapatanNonTagihan(`'+prev+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                                '<i class="la la-angle-left"></i></a>'+
                            '</li>'+
                            '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                                '<i class="la la-ellipsis-h"></i></a>'+
                            '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
                    nex +=  '<li><a href="javascript:void(0)" onclick="pendapatanNonTagihan(`'+next+'&id='+id+'`)" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                                '<i class="la la-angle-right"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="pendapatanNonTagihan(`'+data.last_page_url+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                                '<i class="la la-angle-double-right"></i></a>'+
                            '</li>'
                    $('#nav-pagetable1').html(nav+no_page+nex);
                    mApp.unblock("#m_pelanggan_content2");
                }
        });

                                
    }
    function pendapatanTagihan(address){
        mApp.block("#m_pelanggan_content3",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mengambil Data..."
        });
        var id = document.getElementById('cabang').value;
        var bulan = document.getElementById('bulan').value;
        var page = address+'id='+id+'&bulan='+bulan;
        $.ajax({
                type  		: 'GET',
                url   		: page,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var i;
                    var html = '';
                    if(data.data.length==0){
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{ 
                        var tmp = '-';
                        var aksi = ''; 
                        for(i=0; i<data.data.length; i++){
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 180px;">'+indonesian_date(data.data[i].tgl)+' '+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span class="m--font-success" style="width: 100px;">'+formatRupiah(data.data[i].debet,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 200px;">'+data.data[i].ket+'</span>'+
                                        '</td>'+
                                    '</tr>';  
                        }
                    }
                    $('#show_data2').html(html);
                    var jum = '';
                    var nav = '';
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' Data</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/admin/getpendapatantagihan?page=')}}";
                    for(i=0;i<data.last_page;i++){
                        var aktif = '';
                        if(i==data.current_page-1){
                            aktif= 'm-datatable__pager-link--active';
                        }
                        no_page += '<li><a href="javascript:void(0)" onclick="pendapatanTagihan(`'+url+(i+1)+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
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
                    $('#jumlah_baris2').html(jum);
                    nav += '<li><a href="javascript:void(0)" onclick="pendapatanTagihan(`'+data.first_page_url+'&id='+id+'`)" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                                '<i class="la la-angle-double-left"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="pendapatanTagihan(`'+prev+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                                '<i class="la la-angle-left"></i></a>'+
                            '</li>'+
                            '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                                '<i class="la la-ellipsis-h"></i></a>'+
                            '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
                    nex +=  '<li><a href="javascript:void(0)" onclick="pendapatanTagihan(`'+next+'&id='+id+'`)" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                                '<i class="la la-angle-right"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="pendapatanTagihan(`'+data.last_page_url+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                                '<i class="la la-angle-double-right"></i></a>'+
                            '</li>'
                    $('#nav-pagetable2').html(nav+no_page+nex);
                    mApp.unblock("#m_pelanggan_content3");
                }
        });

                                
    }
    function pengeluaran(address){
        mApp.block("#m_pelanggan_content4",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mengambil Data..."
        });
        var id = document.getElementById('cabang').value;
        var bulan = document.getElementById('bulan').value;
        var page = address+'id='+id+'&bulan='+bulan;
        $.ajax({
                type  		: 'GET',
                url   		: page,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var i;
                    var html = '';
                    if(data.data.length==0){
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{ 
                        var tmp = '-';
                        var aksi = ''; 
                        for(i=0; i<data.data.length; i++){
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 180px;">'+indonesian_date(data.data[i].tgl)+' '+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span class="m--font-danger" style="width: 100px;">'+formatRupiah(data.data[i].kredit,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 200px;">'+data.data[i].ket+'</span>'+
                                        '</td>'+
                                    '</tr>';  
                        }
                    }
                    $('#show_data3').html(html);
                    var jum = '';
                    var nav = '';
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' Data</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/admin/getpengeluaran?page=')}}";
                    for(i=0;i<data.last_page;i++){
                        var aktif = '';
                        if(i==data.current_page-1){
                            aktif= 'm-datatable__pager-link--active';
                        }
                        no_page += '<li><a href="javascript:void(0)" onclick="pengeluaran(`'+url+(i+1)+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
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
                    $('#jumlah_baris3').html(jum);
                    nav += '<li><a href="javascript:void(0)" onclick="pengeluaran(`'+data.first_page_url+'&id='+id+'`)" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                                '<i class="la la-angle-double-left"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="pengeluaran(`'+prev+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                                '<i class="la la-angle-left"></i></a>'+
                            '</li>'+
                            '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                                '<i class="la la-ellipsis-h"></i></a>'+
                            '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
                    nex +=  '<li><a href="javascript:void(0)" onclick="pengeluaran(`'+next+'&id='+id+'`)" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                                '<i class="la la-angle-right"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="pengeluaran(`'+data.last_page_url+'&id='+id+'`)"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                                '<i class="la la-angle-double-right"></i></a>'+
                            '</li>'
                    $('#nav-pagetable3').html(nav+no_page+nex);
                    mApp.unblock("#m_pelanggan_content4");
                }
        });

                                
    }
    function averages(address){
        mApp.block("#m_pelanggan_content5",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mengambil Data..."
        });
        var id = document.getElementById('cabang').value;
        var bulan = document.getElementById('bulan').value;
        var page = address+'id='+id+'&bulan='+bulan;
        $.ajax({
                type  		: 'GET',
                url   		: page,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var i;
                    var html = '';
                    if(data[0].avg==null){
                        data[0].avg='--'
                    }
                        html += '<div class="row" id="avg">'+
                                    data[0].avg+
                                '</div>'; 
                    $('#avg').html(html);
                    mApp.unblock("#m_pelanggan_content5");
                }
        });

                                
    }
</script>
@endsection