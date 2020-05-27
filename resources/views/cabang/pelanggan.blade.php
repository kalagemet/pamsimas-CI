@extends('cabang.layout.master')

@section('title', 'Pelanggan | Sistem Informasi Pamsimas')
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
					Halaman ini menampilkan semua pelanggan dari Pamsimas {{ucfirst(strtolower($user->nama_cabang))}}, harap berhati-hati dalam perubahan.
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
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input id="cari_pelbar" type="text" class="form-control m-input" placeholder="Cari Pelanggan...">
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
									<th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
										Nama Pelanggan
									</span></th>
									<th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 50px;">
										ID
									</span></th>
									<th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 170px;">
										Alamat Rumah
									</span></th>
									<th title="Field #5" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 170px;">
										Tgl Masuk
									</span></th>
									<th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 170px;">
										Update terakhir
									</span></th>
									<th title="Field #7" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 80px;">
										Aksi
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
							<button class="btn btn-success m-btn m-btn--icon m-btn--wide" data-toggle="modal" data-target="#tambah_modal">
								<span>
									<i class="fa fa-plus-circle"></i>
									<span>
										Tambah Pelanggan
									</span>
								</span>
							</button>
						</div>
					</div>
                </div>
            </div>
            <!-- BEGIN:modal -->
            <div class="modal fade" id="tambah_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" action="tambah_pelanggan" method="post"> 
                            {{ csrf_field()}}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    Tambah Pelanggan
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                                </button>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Nama Pelanggan:
                                </label>
                                <input name="nama" id="m_maxlength_1" minlength="3" maxlength="25" required type="text" class="form-control m-input" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Alamat:
                                </label>
                                <input name="alamat" id="m_maxlength_1" maxlength="50" type="text" class="form-control m-input" placeholder="alamat pelanggan">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
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
            <!-- BEGIN:modal -->
            <div class="modal fade" id="ubah_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" action="ubah_pelanggan" method="post"> 
                            {{ csrf_field()}}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    Ubah data pelanggan
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                                </button>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Nama Pelanggan:
                                </label>
                                <div id="nama_form"><div class="m-loader m-loader--primary m-loader--right">
                                    <input disabled name="nama" id="nama_ubah" minlength="3" maxlength="25" required type="text" class="form-control m-input" placeholder="Nama Lengkap">
                                </div></div>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Alamat:
                                </label>
                                <div id="alamat_form"><div class="m-loader m-loader--primary m-loader--right">
                                    <input disabled name="alamat" id="alamat_ubah" maxlength="50" type="text" class="form-control m-input" placeholder="alamat pelanggan">
                                </div></div>
                            </div>
                            <div id="ubah-submit" class="modal-footer">
                                <button type="submit" disabled class="btn m-btn btn-primary m-loader m-loader--light m-loader--right">
                                    Simpan
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
@endsection
@section('script')
{{-- <script src="{{asset('assets/js/component/datatables/daftar-pelanggan.js')}}" type="text/javascript"></script> --}}
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_pelanggan(`{{url('/cabang/get_pelanggan?page=')}}`);   //pemanggilan fungsi tampil barang.
        
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
                                        '<td data-field="Field #2" class="m-datatable__cell m--font-transform-u">'+
                                            '<span style="width: 180px;">'+data.data[i].nama+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span style="width: 50px;">'+data.data[i].id+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span style="width: 170px;">'+data.data[i].alamat+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" class="m-datatable__cell">'+
                                            '<span style="width: 170px;">'+data.data[i].created_at+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 170px;">'+data.data[i].updated_at+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #7" class="m-datatable__cell">'+
                                            '<span style="overflow: visible; position: relative; width: 80px;">'+
                                                '<a id="delete" data-toggle="modal" onclick="UbahData('+data.data[i].id+',`'+data.data[i].nama+'`,`'+data.data[i].alamat+'`)" data-target="#ubah_modal" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah "><i class="fa fa-edit"></i></a> '+
                                                '<a id="delete" href="javascript:void(0)" onClick="Delete('+data.data[i].id+');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Pelanggan "><i class="fa fa-trash-o"></i></a> '+
                                            '</span>'+
                                        '</td>'+
                                    '</tr>';
                        }
                    }
                    $('#show_data').html(html);
                    jum += '<span class="m-datatable__pager-detail">Menampilkan '+data.from+' - '+data.to+' dari '+data.total+' pelanggan</span>'
                    var no_page = '';
                    var nex = '';
                    var url = "{{url('/cabang/get_pelanggan?page=')}}";
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
{{-- search pelanggan --}}
<script>
    $('#cari_pelbar').on('input', function(){
        var cari = $(this).val();
        tampil_pelanggan("{{url('/cabang/cari_pelanggan?key=')}}"+cari); 
    });
</script>
{{-- //hapus pelanggan--}}
<script type="text/javascript">
    var Delete = function(id){
        swal({
            title:"Hapus Pelanggan?",
            text:"Pelanggan ("+id+") tidak akan dapat di pulihkan lagi!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonText:"Hapus"
        })
        .then(function(e){
            e.value&&swal("Dihapus!","Pelanggan telah di dihapus.","success")&&hapus_pelanggan(id);
        })
    }
    $('delete').click(Delete);
</script>
<script type="text/javascript">
    function hapus_pelanggan(id){
        $.ajax({
                type  		: 'GET',
                url   		: "{{url('/cabang/hapus_pelanggan?id=')}}"+id,
                async 		: false,
                dataType 	: 'json',
                success : function(data){
                    if(data.status=='success'){
                        toastr.success(data.message);
                        tampil_pelanggan(`{{url('/cabang/get_pelanggan?page=')}}`);
                    }
                    else{
                        toastr.error(data.message);
                    }
                }
        })
    }
</script>
{{-- ubah data --}}
<script>
    function UbahData(id,nama,alamat){
        var nm = '';
        nm += '<input value="'+nama+'" name="nama" id="nama_ubah" minlength="3" maxlength="25" required type="text" class="form-control m-input" placeholder="Nama Lengkap">'
        $('#nama_form').html(nm);
        nm = '';
        nm += '<input name="alamat" value="'+alamat+'" id="alamat_ubah" maxlength="50" type="text" class="form-control m-input" placeholder="alamat pelanggan">'+
                '<input name=id value="'+id+'" type="hidden" ></input>'
        $('#alamat_form').html(nm);
        nm = '';
        nm += '<button type="submit" class="btn btn-primary">'+
                    'Simpan'+
                '</button>'+
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+
                    'Cancel'+
                '</button>'
        $('#ubah-submit').html(nm);
    }
</script>
@endsection