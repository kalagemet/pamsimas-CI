@extends('cabang.layout.master')
@section('title', 'Riwayat Tagihan | Sistem Informasi Pamsimas')
@section('content')
<!-- BEGIN:isi -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Riwayat Tagihan Pelanggan
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
                                <th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
                                    #Tanggal Riwayat
                                </span></th>
                                <th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
                                    Aksi
                                </span></th>
                                <th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
                                    Oleh
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
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_pelanggan(`{{url('/cabang/get_riwayat_tagihan?page=')}}`);   //pemanggilan fungsi tampil barang.
        
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
                            var oleh = 'Admin';
                            if(data.data[i].id_admin==0){
                                oleh = 'Petugas Cabang';
                            }
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="Field #1" class="m-datatable__cell m--font-transform-u">'+
                                            '<span style="width: 150px;">#'+data.data[i].created_at+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 180px;">'+data.data[i].keterangan+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+oleh+'</span>'+
                                        '</td>'+
                                    '</tr>';
                        }
                    }
                    $('#show_data').html(html);
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' Riwayat</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/cabang/get_riwayat_tagihan?page=')}}";
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