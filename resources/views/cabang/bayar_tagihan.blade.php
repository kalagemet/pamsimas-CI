@extends('cabang.layout.master')
@section('title','Bayar Tagihan | Sistem Informasi Pamsimas')
@section('content')
    <!-- BEGIN:isi -->
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
		<!-- BEGIN: Subheader -->
		<!-- END: Subheader -->
		<div class="m-content">
			<div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
				<div class="m-alert__icon">
					<i class="flaticon-exclamation m--font-warning"></i>
				</div>
				<div class="m-alert__text">
					Status Bayar tidak bisa di rubah setelah tagihan di cetak.
				</div>
			</div>
			<div class="m-portlet m-portlet--mobile">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Daftar Pelanggan
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body"  id="m_pelanggan_content">
                    {{-- Begin:search --}}
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-8">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input id="cari_pelbar" type="text" class="form-control m-input m-input--solid" placeholder="Cari Pelanggan...">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                        <div class="m-input-icon m-input-icon--left">
                                            <select required name="cari_tahun" id="cari_tahun" class="form-control m-input m--font-transform-u">
                                                <option value="" selected>Semua Tagihan</option>
                                                <option value="1" >Tagihan Januari</option>
                                                <option value="2" >Tagihan Februari</option>
                                                <option value="3" >Tagihan Maret</option>
                                                <option value="4" >Tagihan April</option>
                                                <option value="5" >Tagihan Mei</option>
                                                <option value="6" >Tagihan Juni</option>
                                                <option value="7" >Tagihan Juli</option>
                                                <option value="8" >Tagihan Agustus</option>
                                                <option value="9" >Tagihan September</option>
                                                <option value="10" >Tagihan Oktober</option>
                                                <option value="11" >Tagihan November</option>
                                                <option value="12" >Tagihan Desember</option>
                                            </select>
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
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
									<th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										ID
									</span></th>
									<th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
										Nama Pelanggan
									</span></th>
									<th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 170px;">
										Alamat Rumah
									</span></th>
									<th title="Field #5" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Jumlah Tagihan
									</span></th>
									<th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 120px;">
										Tagihan 
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
					<div class="m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-stack__item--right">
							<button disabled type="button" id="tbl_cetak" onclick="cetak_tagihan()" class="btn btn-success m-btn m-btn--icon m-btn--wide">
								<span>
									<i class="fa fa-print"></i>
									<span>
										Cetak Tagihan
									</span>
								</span>
							</button>
						</div>
					</div>
                </div>
                <!-- BEGIN:modal -->
                <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right"> 
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                        Tagihan Pelanggan <b id="user_tagihan"></b>
                                        <div id="span_keterangan" class="form-control-feedback m--font-warning"></div>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            ×
                                        </span>
                                    </button>
                                </div>
                                <div class="form-group m-form__group">
                                    <div class="m-demo">
                                            <div id="isi_bayar"></div>
                                    </div>
                                </div>
                                <div id="ubah-submit" class="modal-footer">
                                    <button disabled class="btn m-btn btn-success m-loader m-loader--light m-loader--right">
                                        Bayar
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END:modal -->
            </div>
        </div>
	</div>
@endsection
@section('script')
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_pelanggan(`{{url('/cabang/get_bayartagihan?page=')}}`);   //pemanggilan fungsi tampil barang.
        
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
                        document.getElementById("tbl_cetak").disabled = true;
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{
                        document.getElementById("tbl_cetak").disabled = false;
                        for(i=0; i<data.data.length; i++){
                            var jml = '';
                            var aksi = '';
                            if(data.data[i].jml_tagihan==0){
                                jml = '<span class="m-badge m-badge--danger m-badge--wide">Tidak ada</span>';
                                aksi = '<a href="/cabang/cetak_ulang?id_pel='+data.data[i].id+'" class="btn m-btn--square  btn-outline-warning">Cetak ulang</a>'
                            }else{
                                jml = '<span class="m-badge m-badge--success m-badge--wide">'+data.data[i].jml_tagihan+' tagihan</span>';
                                aksi = '<a class="btn m-btn--square  btn-outline-success" onclick="bayarTagihan('+data.data[i].id+')" data-toggle="modal" data-target="#bayar" >Bayar</a>&nbsp;'+
                                        '<a href="/cabang/cetak_ulang?id_pel='+data.data[i].id+'" class="btn m-btn--square  btn-outline-warning"><i class="fa fa-repeat"></i></a>'
                            }
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+data.data[i].id+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell m--font-transform-u">'+
                                            '<span style="width: 180px;">'+data.data[i].nama+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span style="width: 170px;">'+data.data[i].alamat+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+jml+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="overflow: visible; position: relative; width: 120px;">'+
                                                aksi+
                                            '</span>'+
                                        '</td>'+
                                    '</tr>';
                        }
                    }
                    $('#show_data').html(html);
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' pelanggan</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/cabang/get_bayartagihan?page=')}}";
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
<script>
    $('#cari_pelbar').on('input', function(){
        var cari = $(this).val();
        tampil_pelanggan("{{url('/cabang/cari_bayartagihan?cari=')}}"+cari); 
    });
</script>
<script>
    $('#cari_tahun').on('change', function(){
        var cari = $(this).val();
        tampil_pelanggan("{{url('/cabang/cari_bulantagihan?bulan=')}}"+cari); 
    });
</script>
<script>
    function cetak_tagihan(){
        var tp = document.getElementById("cari_tahun");
        if(tp.value=="" || tp.value ==null){
            tp=13;
        }else{tp = tp.value}
        window.location.href = `{{url('/cabang/cetak_tagihan?bulan=')}}`+tp;
    }
</script>
{{-- bayar 1 --}}
<script>
    function bayarTagihan(id_pel){
        $.ajax({
            type    :'GET',
            url     : "{{url('/cabang/getbayardetail?id_pel=')}}"+id_pel,
            async   : true,
            dataType   :'json',
            success : function(data){
                var isi = '';
                if(data.length==0){
                    isi = '<div align="center">Tidak ada data</div>';
                }else{
                    for(i=0;i<data.length;i++){
                        var total = data[i]
                        isi +=       
                                        '<div class="m-demo__preview"><div class="m-list-timeline">'+
                                    '<div class="m-list-timeline__items">'+
                                        '<div class="m-list-timeline__item">'+
                                            '<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>'+
                                            '<span class="m-list-timeline__text">ID Tagihan : '+
                                                data[i].id+
                                            '</span>'+
                                            '<span class="m-list-timeline__time">'+
                                                echoBulan(data[i].bulan)+
                                            '</span>'+
                                        '</div>'+
                                        '<div class="m-list-timeline__item">'+
                                            '<span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>'+
                                            '<span class="m-list-timeline__text">Jml meter : '+
                                                data[i].jml_meter+
                                            ' ('+formatRupiah(data[i].tarif,"Rp. ")+'/m)</span>'+
                                        '</div>'+
                                        '<div class="m-list-timeline__item">'+
                                            '<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>'+
                                            '<span class="m-list-timeline__text">Keterlambatan : '+
                                                data[i].terlambat+
                                            ' bulan x '+formatRupiah(data[i].tarif_denda,"Rp. ")+'</span>'+
                                        '</div>'+
                                        '<div class="m-list-timeline__item">'+
                                            '<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>'+
                                            '<span class="m-list-timeline__text">Total : '+
                                                formatRupiah(data[i].tarif,"Rp. ")+' (denda) '+formatRupiah(data[i].totaldenda,"Rp. ")+
                                            '</span>'+
                                            '<span class="m-list-timeline__time">'+
                                                '<b>'+formatRupiah(data[i].subtotal,"Rp. ")+'</b>'+
                                            '</span>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    }
                }
                $('#isi_bayar').html(isi);
                isi = '<a id="bayarsubmit" onClick="konfirmasi('+id_pel+')" href="javascript:void(0)" class="btn btn-primary">'+
                                    'Bayar'+
                                '</a>'+
                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+
                                    'Cancel'+
                                '</button>';
                $('#ubah-submit').html(isi);
            },
            error : function(){
                $("#bayar").modal('hide');
                toastr.error('Gagal mengambil Data');
            }
        })
    }
</script>
<script type="text/javascript" src="{{asset('assets/js/bulan.js')}}"></script>
<script type="text/javascript">
    var konfirmasi = function(id_pel){
        $("#bayar").modal('hide');
        swal({
            title:"Anda Yakin?",
            text:"Pembayaran untuk ("+id_pel+") tidak akan dapat di batalkan!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonText:"Bayar"
        })
        .then(function(e){
            e.value&&submitBayar(id_pel);
        })
    }
    $('bayarsubmit').click(konfirmasi);
</script>
{{-- //bayar 2--}}
<script type="text/javascript">
    function submitBayar(id_pel){
        $.ajax({
                type  		: 'POST',
                url   		: "{{url('/cabang/bayar')}}",
                data        : {
                    "_token": "{{ csrf_token() }}" ,
                    'id_pel': id_pel,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // async 		: true,
                // dataType 	: 'json',
                success : function(data){
                    if(data==null){
                        swal("Berhasil!","Tagihan telah terbayar.","success");
                    }else{
                        swal("Gagal!",data.message,"error");
                    }
                }, error : function(){
                    swal("Gagal!","gagal mengirim permintaan","error");
                }
        });
        tampil_pelanggan(`{{url('/cabang/get_bayartagihan?page=')}}`);
    }
</script>
@endsection