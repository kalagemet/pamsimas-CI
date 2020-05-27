@extends('cabang.layout.master')
@section('title','Input Tagihan | Sistem Informasi Pamsimas')
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
                            <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                <button onclick="setKebijakan()" data-toggle="modal" data-target="#set_kebijakan" class="btn btn-outline-info">
                                    <span>
                                        <i class="fa fa-gear"></i>
                                        <span>
                                            Set Kebijakan
                                        </span>
                                    </span>
                                </button>
                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                    {{-- End:search --}}
					<!-- begin: Datatable -->
					<div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
						<table  class="m-datatable__table" id="html_table" width="100%" style="display: block; min-height: 300px; overflow-x: auto; text-align: center; vertical-align: middle;">
							<thead class="m-datatable__head">
								<tr class="m-datatable__row" style="left: 0px;">
									<th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
										No.
									</span></th>
									<th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 170px;">
										Nama Pelanggan
									</span></th>
									<th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 80px;">
										ID
									</span></th>
									<th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
										Alamat Rumah
									</span></th>
									<th title="Field #5" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Tagihan Terakhir
									</span></th>
									<th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Tarif /m
									</span></th>
									<th title="Field #7" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Meter Bulan ini
									</span></th>
									<th title="Field #8" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
										Input
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
            <!-- BEGIN:modal -->
            <div class="modal fade" id="set_kebijakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right"> 
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    Kebijakan {{ucwords($user->nama_cabang)}}
                                    <div id="span_keterangan" class="form-control-feedback m--font-warning"></div>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                                </button>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Tarif per meter air:
                                </label>
                                <div id="tarif_form"><div class="m-loader m-loader--primary m-loader--right">
                                    <input disabled required type="text" class="form-control m-input" placeholder="Tarif dalam Rupiah">
                                </div></div>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Tarif Keterlambatan tiap bulan:
                                </label>
                                <div id="penalti_form"><div class="m-loader m-loader--primary m-loader--right">
                                    <input disabled type="text" class="form-control m-input" placeholder="Tarif dalam Rupiah">
                                </div></div>
                            </div>
                            <div id="ubah-submit" class="modal-footer">
                                <button disabled class="btn m-btn btn-primary m-loader m-loader--light m-loader--right">
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
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_pelanggan(`{{url('/cabang/get_tagihanpelanggan?page=')}}`);   //pemanggilan fungsi tampil barang.
        
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
                            var aksi ='';
                            if(data.data[i].input==1){
                                aksi = '<i class="fa fa-check">&ensp;|&ensp;</i>'+
                                        '<a href="/cabang/ubah_tagihan?id_pel='+data.data[i].id+'" class="btn btn-outline-warning m-btn m-btn--icon m-btn--outline">'+
                                            '<span>'+
                                                '<i class="fa fa-edit"></i>'+
                                                '<span>'+
                                                    'Ubah'+
                                                '</span>'+
                                            '</span>'+
                                        '</a>';
                            }else{
                                aksi = '<div class="input-group">'+
                                            '<input onkeyPress="return angka(event)" id="form_'+data.data[i].id+'" type="text" maxlength="4" class="form-control m-input" placeholder="Meter">'+
                                            '<div class="input-group-append">'+
                                                '<a href="javascript:void(0)" onClick="input_tagihan('+data.data[i].id+','+data.current_page+')" class="btn btn-brand">'+
                                                    '<i class="fa fa-plus-circle"></i>'+
                                                '</a>'+
                                            '</div>'+
                                        '</div>';
                            }
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="Field #1" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell m--font-transform-u">'+
                                            '<span style="width: 170px;">'+data.data[i].nama+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span style="width: 80px;">'+data.data[i].id+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span style="width: 150px;">'+data.data[i].alamat+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+echoBulan(data.data[i].tagihan_terakhir)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+formatRupiah(parseInt(data.data[i].tarif),"Rp. ")+',-</span>'+
                                        '</td>'+
                                        '<td data-field="Field #7" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+data.data[i].jml_meter+' m</span>'+
                                        '</td>'+
                                        '<td data-field="Field #8" class="m-datatable__cell">'+
                                            '<span style="overflow: visible; position: relative; width: 150px;">'+
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
                    var url = "{{url('/cabang/get_tagihanpelanggan?page=')}}";
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
        tampil_pelanggan("{{url('/cabang/cari_tagihanpelanggan?key=')}}"+cari); 
    });
</script>
<script type="text/javascript">
    function setKebijakan(){
        $.ajax({
                type  		: 'GET',
                url   		: "{{url('/cabang/get_tarif')}}",
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    if(data.length!=0){
                        var tarif = '<input value="'+formatRupiah(data.tarif,"Rp. ")+'" onkeyPress="return angka(event)" id="tarif_ubah" maxlength="30" required type="text" class="form-control m-input" placeholder="Tarif dalam Rupiah">'+
                                '<div class="form-control-feedback m--font-info"><i>Nilai dalam mata uang Rupiah</i></div>'
                        $('#tarif_form').html(tarif);
                        tarif = '<input onkeyPress="return angka(event)" value="'+formatRupiah(data.penalti,"Rp. ")+'" id="penalti_ubah" maxlength="30" required type="text" class="form-control m-input" placeholder="Tarif dalam Rupiah">'+
                                '<div class="form-control-feedback m--font-info"><i>Nilai dalam mata uang Rupiah</i></div>'
                        $('#penalti_form').html(tarif);
                        tarif = '<a onClick="submitKebijakan()" href="javascript:void(0)" class="btn btn-primary">'+
                                    'Simpan'+
                                '</a>'+
                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+
                                    'Cancel'+
                                '</button>'
                        $('#ubah-submit').html(tarif);
                        var dataterakhir = '';
                        if(data.updated_at==null){
                            dataterakhir = data.created_at;
                        }else{
                            dataterakhir = data.updated_at;
                        }
                        tarif = 'terakhir di perbarui '+dataterakhir;
                        $('#span_keterangan').html(tarif);
                    }
                },
            error : function(){
                $("#set_kebijakan").modal('hide');
                toastr.error('Gagal Mengirim Data');
            }
        })
    }
</script>
{{-- submit kebijakan --}}
<script type="text/javascript">
    function submitKebijakan(){
        var tarif = document.getElementById("tarif_ubah").value.replace(/[^,\d]/g, '');
        var penalti = document.getElementById("penalti_ubah").value.replace(/[^,\d]/g, '');
        var load = '<button disabled class="btn m-btn btn-primary m-loader m-loader--light m-loader--right">'+
                        'Simpan'+
                    '</button>'+
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">'+
                        'Cancel'+
                    '</button>'
            $('#ubah-submit').html(load);
        $.ajax({
            type  		: 'POST',
            url   		: "{{url('/cabang/set_tarif')}}",
            data        : {
                "_token": "{{ csrf_token() }}" ,
                'tarif' : tarif,
                'penalti': penalti
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // async 		: true,
            // dataType 	: 'json',
            success : function(data){
                if(data.status=='success'){
                    toastr.success(data.message);
                }
                else{
                    toastr.error(data.message);
                }
                $("#set_kebijakan").modal('hide');
            },
            error : function(){
                $("#set_kebijakan").modal('hide');
                toastr.error('Gagal Mengirim Data');
            }
        });
    }
</script>
{{-- //input tagihan --}}
<script type="text/javascript">
    function input_tagihan(id,page){
        var meter = document.getElementById('form_'+id);
        if(meter.value==null || meter.value == ''){
            meter.focus();
            return false;
        }else{
            mApp.block("#html_table",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            $.ajax({
                type  		: 'POST',
                url   		: "{{url('/cabang/input_tagihan')}}",
                data        : {
                    "_token": "{{ csrf_token() }}" ,
                    'jml_meter' : meter.value,
                    'id_pelanggan': id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // async 		: true,
                // dataType 	: 'json',
                success : function(data){
                    if(data.status=='success'){
                        toastr.success(data.message);
                        tampil_pelanggan(`{{url('/cabang/get_tagihanpelanggan?page=')}}`+page);
                    }
                    else{
                        toastr.error(data.message);
                        mApp.unblock("#html_table");
                    }
                },
                error : function(){
                    toastr.error('Gagal Mengirim Data');
                    mApp.unblock("#html_table");
                }
            })
        }
    }
</script>
{{-- //format --}}
<script type="text/javascript">
    var tarif = document.getElementById("tarif_form");
    var penalti = document.getElementById("penalti_form");
    tarif.addEventListener('keyup', function(e){
        tarif = document.getElementById("tarif_ubah");
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        tarif.value = formatRupiah(tarif.value,"Rp. ");
    });
    penalti.addEventListener('keyup', function(e){
        penalti = document.getElementById("penalti_ubah");
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        penalti.value = formatRupiah(penalti.value,"Rp. ");
    });
</script>
<script type="text/javascript" src="{{asset('assets/js/bulan.js')}}"></script>
@endsection