@extends('cabang.layout.master')
@section('title','Keuangan | Sistem Informasi Pamsimas')
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
					Pembukuan dari tagihan pelanggan tidak dapat di ubah.
				</div>
			</div>
			<div class="m-portlet m-portlet--mobile">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Data Keuangan Pamsimas {{ucfirst(strtolower($user->nama_cabang))}}
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body"  id="m_pelanggan_content">
                    {{-- Begin:search --}}
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <span>Tahun : </span>
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <select required name="tahun" id="tahun" class="form-control m-input m--font-transform-u">
                                                @for ($year=$tahun_rilis; $year <= date('Y'); $year++)
                                                    <option @if($year==$tahun_ini) selected @endif value="{{$year}}">{{$year}}</option>
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
                            <div class="col-xl-4 order-1 order-xl-1 m--align-right">
                                <span></span>
                                <button data-toggle="modal" data-target="#tambah_modal" class="btn btn-outline-info">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                        <span>
                                            Tambah Data
                                        </span>
                                    </span>
                                </button>
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
									<th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 300px;">
										Tanggal Transaksi
									</span></th>
									<th title="Field #3" class="m-datatable__cell m-datatable__cell--sort" style="text-align:center;"><span style="width: 200px;">
										Debet
									</span></th>
									<th title="Field #4" class="m-datatable__cell m-datatable__cell--sort" style="text-align:center;"><span style="width: 200px;">
										Kredit
									</span></th>
									<th title="Field #5" class="m-datatable__cell m-datatable__cell--sort" style="text-align:center;"><span style="width: 250px;">
										Saldo
									</span></th>
									<th title="Field #6" class="m-datatable__cell m-datatable__cell--sort" style="text-align:left;"><span style="width: 200px;">
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
					<div class="m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-stack__item--right">
                            <button type="button" href="javascript:void(0)" onclick="cetak_excel()" disabled class="btn btn-primary m-btn m-btn--icon m-btn--wide" id="tbl_excel">
                                <span>
                                    <i class="fa fa-file-excel-o"></i>
                                    <span>
                                        Export Excel
                                    </span>
                                </span>
                            </button>
							<button type="button" href="javascript:void(0)" onclick="cetak_laporan()" disabled class="btn btn-success m-btn m-btn--icon m-btn--wide" id="tbl_cetak">
								<span>
									<i class="fa fa-print"></i>
									<span>
										Cetak Laporan
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
                        <form class="m-form m-form--fit m-form--label-align-right" action="tambah_keuangan" method="post"> 
                            {{ csrf_field()}}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    Tambah Data
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                                </button>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Jenis Keuangan:
                                </label>
                                <select required name="type" class="form-control m-input m--font-transform-u">
                                    <option value="1">Debet</option>
                                    <option value="2">Kredit</option>
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Nilai:
                                </label>
                                <input required onkeyPress="return angka(event)" name="nilai" id="rupiah" minlength="3" maxlength="50" type="text" class="form-control m-input" placeholder="Banyaknya">
                                <div class="form-control-feedback m--font-warning">dalam mata uanag Rupiah</div>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    Keterangan:
                                </label>
                                <input required name="ket" id="m_maxlength_1" maxlength="50" type="text" class="form-control m-input" placeholder="Keterangan">
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
        </div>
	</div>
@endsection
@section('script')
<script src="{{asset('assets/js/tanggal_helper.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_data(`{{url('/cabang/get_datapembukuan?tahun=')}}`,{{$tahun_ini}});   //pemanggilan fungsi tampil barang.
        
        // $('#html_table').mDatatable();
        
        // fungsi tampil barang
        function tampil_data(page, thn){
            mApp.block("#html_table",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            $.ajax({
                type  		: 'GET',
                url   		: page+thn,
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    var i;
                    var html = '';
                    if(data.data.length==0){
                        document.getElementById("tbl_cetak").disabled = true;
                        document.getElementById("tbl_excel").disabled = true;
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{
                        document.getElementById("tbl_cetak").disabled = false; 
                        document.getElementById("tbl_excel").disabled = false;
                        var tmp = '-';
                        var aksi = ''; 
                        for(i=0; i<data.data.length; i++){
                            var hapus='';
                            if(data.data[i].akses==1 && i==0 && data.current_page==1){
                                hapus = '&nbsp;<a href"javascript:void(0)" onclick="hapus_data('+data.data[i].id+')" class="m-badge  m-badge--warning m-badge--wide m-link m--font-light">Hapus<a/>';
                            }
                            // cek saldo
                            var saldo = '';
                            if (data.data[i].saldo<=0) {
                                saldo = '<span class="m-badge  m-badge--danger m-badge--wide m-link m--font-light" style="width: 250px; text-align:right;">'+formatRupiah(data.data[i].saldo,"Rp. ")+'</span>';
                            }else{
                                saldo = '<span class="m--font-primary" style="width: 250px; text-align:right;">'+formatRupiah(data.data[i].saldo,"Rp. ")+'</span>';
                            }
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px; text-align:center;">'+(data.from+i)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell">'+
                                            '<span style="width: 300px;">'+indonesian_date(data.data[i].created_at)+' '+hapus+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span class="m--font-success" style="width: 200px; text-align:right;">'+formatRupiah(data.data[i].debet,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span class="m--font-danger" style="width: 200px; text-align:right;">'+formatRupiah(data.data[i].kredit,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" class="m-datatable__cell">'+
                                            saldo+
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
                    var url = "{{url('/cabang/get_datapembukuan?page=')}}";
                    for(i=0;i<data.last_page;i++){
                        var aktif = '';
                        if(i==data.current_page-1){
                            aktif= 'm-datatable__pager-link--active';
                        }
                        no_page += '<li><a href="javascript:void(0)" onclick="tampil_data(`'+url+(i+1)+'&tahun=`,'+thn+')"  class="m-datatable__pager-link m-datatable__pager-link-number '+aktif+'" data-page="'+(i+1)+'" title="'+(i+1)+'">'+(i+1)+'</a></li>';
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
                    nav += '<li><a href="javascript:void(0)" onclick="tampil_data(`'+data.first_page_url+'&tahun=`,'+thn+')" class="m-datatable__pager-link m-datatable__pager-link--first" data-page="1">'+
                                '<i class="la la-angle-double-left"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="tampil_data(`'+prev+'&tahun=`,'+thn+')"  class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="1">'+
                                '<i class="la la-angle-left"></i></a>'+
                            '</li>'+
                            '<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev" data-page="1">'+
                                '<i class="la la-ellipsis-h"></i></a>'+
                            '</li><li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>'
                    nex +=  '<li><a href="javascript:void(0)" onclick="tampil_data(`'+next+'&tahun=`,'+thn+')" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="2">'+
                                '<i class="la la-angle-right"></i></a>'+
                            '</li>'+
                            '<li><a href="javascript:void(0)" onclick="tampil_data(`'+data.last_page_url+'&tahun=`,'+thn+')"  class="m-datatable__pager-link m-datatable__pager-link--last" data-page="15">'+
                                '<i class="la la-angle-double-right"></i></a>'+
                            '</li>'
                    $('#nav-pagetable').html(nav+no_page+nex);
                    mApp.unblock("#html_table");
                }
            });
        }
    // });
</script>
<script type="text/javascript">
    $('#tahun').on('change', function(e){
        var th = e.target.value;
        tampil_data(`{{url('/cabang/get_datapembukuan?tahun=')}}`,th); 
    });
</script>
<script type="text/javascript">
    function hapus_data(id){
        mApp.block("#html_table",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
        });
        $.ajax({
                type  		: 'POST',
                url   		: "{{url('/cabang/hapus_transaksi')}}",
                data        : {
                    "_token": "{{ csrf_token() }}" ,
                    'id': id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async 		: true,
                dataType 	: 'json',
                success : function(data){
                    if(data.status=="success"){
                        toastr.success(data.message)
                    }else{
                        toastr.error(data.message)
                    }
                    tampil_data(`{{url('/cabang/get_datapembukuan?tahun=')}}`,{{$tahun_ini}});
                }, error : function(){
                    swal("Gagal!","gagal mengirim permintaan","error");
                    tampil_data(`{{url('/cabang/get_datapembukuan?tahun=')}}`,{{$tahun_ini}});
                }
        });
    }
</script>
<script>
    function cetak_laporan(){
        var tp = document.getElementById("tahun");
        if(tp.value=="" || tp.value ==null){
            tp={{$tahun_ini}};
        }else{tp = tp.value}
        window.location.href = `{{url('/cabang/cetak_laporan?tahun=')}}`+tp;
    }
    function cetak_excel(){
        var tp = document.getElementById("tahun");
        if(tp.value=="" || tp.value ==null){
            tp={{$tahun_ini}};
        }else{tp = tp.value}
        window.location.href = `{{url('/cabang/cetak_excel?tahun=')}}`+tp;
    }
</script>
<script type="text/javascript">
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
</script>
@endsection