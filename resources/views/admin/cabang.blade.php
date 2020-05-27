@extends('admin.layout.master')

@section('title', 'Cabang | Sistem Informasi Pamsimas')
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
					Halaman ini menampilkan semua cabang dari sistem, harap berhati-hati dalam perubahan.
				</div>
			</div>
			<div class="m-portlet m-portlet--mobile">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Daftar Cabang
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body"  id="m_cabang_content">
					<!-- begin: Datatable -->
					<div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
						<table class="m-datatable__table" id="html_table" width="100%" style="display: block; min-height: 300px; overflow-x: auto;">
							<thead class="m-datatable__head">
								<tr class="m-datatable__row" style="left: 0px;">
									<th title="Field #1" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 30px;">
										No.
									</span></th>
									<th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 180px;">
										Nama Cabang
									</span></th>
									<th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
										Alamat
									</span></th>
									<th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">
										ID
									</span></th>
									<th title="Field #7" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 80px;">
										Status
									</span></th>
									<th title="Field #10" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">
										Aksi
									</span></th>
								</tr>
							</thead>
							<tbody class="m-datatable__body" id="show_data"></tbody>
						</table>
					</div>
					<!--end: Datatable -->
					<br/><br/>
					<div class="m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-stack__item--right">
							<button class="btn btn-success m-btn m-btn--icon m-btn--wide" data-toggle="modal" data-target="#tambah_modal">
								<span>
									<i class="fa fa-plus-circle"></i>
									<span>
										Tambah Cabang
									</span>
								</span>
							</button>
						</div>
					</div>
				</div>
				<!-- BEGIN:modal -->
				<div class="modal fade" id="tambah_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<form class="m-form m-form--fit m-form--label-align-right" action="admin.tambah_cab" method="post"> 
								{{ csrf_field()}}
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">
										Tambah Akun Cabang
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">
											×
										</span>
									</button>
								</div>
								<div class="form-group m-form__group">
									<label for="example_input_full_name">
										Nama Cabang:
									</label>
									<input name="nama" id="m_maxlength_1" minlength="3" maxlength="25" required type="text" class="form-control m-input" placeholder="Username">
									<span class="m-form__help">
										Ini juga digunakan sebagai password pertama untuk login pada sistem
									</span>
								</div>
								<div class="form-group m-form__group">
									<label for="example_input_full_name">
										Alamat:
									</label>
									<input name="alamat" id="m_maxlength_1" minlength="3" maxlength="25" required type="text" class="form-control m-input" placeholder="alamat cabang">
								</div>
								<div class="form-group m-form__group">
									<label for="example_input_full_name">
										Nomor Telepon:
									</label>
									<input onkeyPress="return angka(event)" name="no_tlp" id="m_inputmask_4" minlength="10" maxlength="13" required type="text" class="form-control m-input" placeholder="Nomor telepon">
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
				<div class="modal fade show" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="m-portlet__body" id="conten-info">
								<ul class="nav nav-tabs  m-tabs-line" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_1" role="tab" aria-selected="false">
											Data Cabang
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_3" role="tab" aria-selected="false">
											Data Pelanggan
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_2" role="tab" aria-selected="true">
											Logo
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane" id="m_tabs_6_1" role="tabpanel">
										<div class="m-demo__preview">
											<div class="m-list-timeline">
												<div class="m-list-timeline__items">
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
														<span class="m-list-timeline__text">ID Pelanggan : </span>
														<span class="m-list-timeline__time"><div id="modal1"></div></span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
														<span class="m-list-timeline__text">Nomor Telpon : </span>
														<span class="m-list-timeline__time"><div id="modal2"></div></span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
														<span class="m-list-timeline__text">Dibuat pada : </span>
														<span class="m-list-timeline__time"><div id="modal3"></div></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="m_tabs_6_2" role="tabpanel">
										<div class="m-stack m-stack--ver m-stack--general">
											<div class="m-stack__item m-stack__item--center m-stack__item--middle">
												<div id="modal4"></div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="m_tabs_6_3" role="tabpanel">
										<div class="m-demo__preview">
											<div class="m-list-timeline">
												<div class="m-list-timeline__items">
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
														<span class="m-list-timeline__text">Jumlah Pelanggan : </span>
														<span class="m-list-timeline__time"><div id="modal5"></div></span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
														<span class="m-list-timeline__text">Saldo : </span>
														<span class="m-list-timeline__time"><div id="modal6"></div></span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--primary"></span>
														<span class="m-list-timeline__text">Rata-rata meter : </span>
														<span class="m-list-timeline__time"><div id="modal7"></div></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END:modal -->
			</div>
		</div>
	</div>
	<!-- END:isi -->
@endsection
@section('script')
	<script src="{{asset('assets/demo/default/custom/components/datatables/base/html-table.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		mApp.block("#m_cabang_content",{
			overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
		});
		
		// $(document).ready(function(){
			tampil_cabang();   //pemanggilan fungsi tampil barang.
			
			// $('#html_table').dataTable();
			
			//fungsi tampil barang
			function tampil_cabang(){
				$.ajax({
					type  		: 'GET',
					url   		: '{{url('/admin/get_cabang')}}',
					async 		: true,
					dataType 	: 'json',
					success : function(data){
						var html = '';
						var i;
						if(data.length==0){
							html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
										'<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
											'<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
										'</div>'+
									'</div>'
						}else{
							for(i=0; i<data.length; i++){
								var status = (data[i].active==1) ? '<span class="m-badge  m-badge--success m-badge--wide">Aktif</span></span>':'<span class="m-badge  m-badge--danger m-badge--wide">Non Aktif</span>';
								var aktivasi = (data[i].active==1) ? '<a id="nonaktiv" href="javascript:void(0)" onClick="Nonaktifkan('+data[i].id+');" class="dropdown-item" ><i class="fa fa-close"></i> Nonaktifkan</a>':'<a id="aktiv" href="javascript:void(0)" onClick="Aktivasi('+data[i].id+');" class="dropdown-item"><i class="fa fa-check"></i> Aktifkan</a>'
								html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
											'<td data-field="No" class="m-datatable__cell">'+
												'<span style="width: 30px;">'+(i+1)+'</span>'+
											'</td>'+
											'<td data-field="Field #2" class="m-datatable__cell m--font-transform-u">'+
												'<span style="width: 180px;">'+data[i].nama_cabang+'</span>'+
											'</td>'+
											'<td data-field="Field #3" class="m-datatable__cell">'+
												'<span style="width: 150px;">'+data[i].alamat+'</span>'+
											'</td>'+
											'<td data-field="Field #4" class="m-datatable__cell">'+
												'<span style="width: 110px;">'+data[i].id+'</span>'+
											'</td>'+
											'<td data-field="Field #7" class="m-datatable__cell">'+
												'<span style="width: 80px;">'+status+'</span>'+
											'</td>'+
											'<td data-field="Field #10" class="m-datatable__cell">'+
												'<span style="overflow: visible; position: relative; width: 110px;">'+
													'<div class="dropdown">'+
														'<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">'+
															'<i class="la la-ellipsis-h"></i>'+
														'</a>'+
														'<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-132px, 33px, 0px);">'+
															aktivasi+
															'<a id="reset" href="javascript:void(0)" onClick="Reset('+data[i].id+');" class="dropdown-item"><i class="fa fa-refresh"></i> Reset Password</a>'+
															'<a class="dropdown-item" data-toggle="modal" data-target="#info_modal" href="javasrtipt:void(0)" onclick="modalinfo('+data[i].id+')"><i class="fa fa-info"></i> Informasi Cabang</a>'+
														'</div>'+
													'</div>'+
													'<a id="delete" href="javascript:void(0)" onClick="Delete('+data[i].id+');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Cabang "><i class="fa fa-trash-o"></i></a></span>'+
												'</span>'+
											'</td>'+
										'</tr>';
							}
						}
						$('#show_data').html(html);
					}
				});
				mApp.unblock("#m_cabang_content")
			}
		// });
	</script>
	<!-- //flash berhasil -->
	<script type="text/javascript">
		toastr.options = {
			"closeButton": false,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
	</script>
	@if(Session::has('success'))
	<script type="text/javascript">
		toastr.success("{{Session::get('success')}}");
	</script>
	@endif
	@if(Session::has('error'))
	<script type="text/javascript">
		toastr.error("{{Session::get('error')}}");
	</script>
	@endif
	<script type="text/javascript">
		var Nonaktifkan = function(id){
			swal({
                title:"Nonaktifkan akun?",
                text:"Akun ("+id+") tidak akan bisa login lagi!",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Nonaktifkan"
            })
            .then(function(e){
				e.value&&swal("Nonaktif!","Akun telah di nonatifkan.","success")&&toggle_aktiv(id);
            })
		}
		$('nonaktiv').click(Nonaktifkan);
	</script>
	
	<script type="text/javascript">
		var Aktivasi = function(id){
			swal({
                title:"Aktifkan akun?",
                text:"Akun ("+id+") akan di aktifkan untuk login lagi!",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Aktifkan"
            })
            .then(function(e){
				e.value&&swal("Aktif!","Akun telah di aktifkan.","success")&&toggle_aktiv(id);
            })
		}
		$('aktiv').click(Aktivasi);
	</script>

	<script type="text/javascript">
		function toggle_aktiv(id){
			$.ajax({
					type  		: 'GET',
					url   		: "{{url('/admin/set_status?id=')}}"+id,
					async 		: true,
					dataType 	: 'json',
					success : function(data){
						if(data.status=='success'){
							toastr.success(data.message);
							tampil_cabang();
						}
						else{
							toastr.error(data.message);
						}
					}
			})
		}
	</script>
	<script type="text/javascript">
		function hapus_akun(id){
			$.ajax({
					type  		: 'GET',
					url   		: "{{url('/admin/hapus_cabang?id=')}}"+id,
					async 		: true,
					dataType 	: 'json',
					success : function(data){
						if(data.status=='success'){
							toastr.success(data.message);
							tampil_cabang();
						}
						else{
							toastr.error(data.message);
						}
					}
			})
		}
	</script>

	<script type="text/javascript">
		var Delete = function(id){
			swal({
				title:"Hapus akun?",
				text:"Akun ("+id+") tidak akan dapat di pulihkan lagi!",
				type:"warning",
				showCancelButton:!0,
				confirmButtonText:"Hapus"
			})
			.then(function(e){
				e.value&&swal("Dihapus!","Akun telah di dihapus.","success")&&hapus_akun(id);
			})
		}
		$('delete').click(Delete);
	</script>
	<script type="text/javascript">
		function reset_akun(id){
			$.ajax({
					type  		: 'GET',
					url   		: "{{url('/admin/reset_cabang?id=')}}"+id,
					async 		: true,
					dataType 	: 'json',
					success : function(data){
						if(data.status=='success'){
							toastr.success(data.message);
							tampil_cabang();
						}
						else{
							toastr.error(data.message);
						}
					}
			})
		}
	</script>

	<script type="text/javascript">
		var Reset = function(id){
			swal({
				title:"Reset akun?",
				text:"Password akun ("+id+") akan di set ke default lagi!",
				type:"warning",
				showCancelButton:!0,
				confirmButtonText:"Reset"
			})
			.then(function(e){
				e.value&&swal("Berhasil!","Akun telah di reset.","success")&&reset_akun(id);
			})
		}
		$('reset').click(Reset);
	</script>

	<script type="text/javascript">
		function modalinfo(id){
			mApp.block("#conten-info",{
				overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
			}),
			$.ajax({
						type  		: 'GET',
						url   		: "{{url('/admin/getdetail_cabang?id=')}}"+id,
						async 		: true,
						dataType 	: 'json',
						success : function(data){
							if(data.length!=0){
								$('#modal1').html(data.id);
								$('#modal2').html(data.no_tlp);
								$('#modal3').html(data.created_at);
								$('#modal4').html(`<img class="m--margin-right-20" width="250px" onerror=this.src="{{asset('assets/src/media/app/img/users/100_1.jpg')}}" src="/logo_cabang?id_cab=`+id+`">`);
								$('#modal5').html(data.jml_pelanggan);
								$('#modal6').html('Rp. '+data.saldo+',-');
								$('#modal7').html(data.avg+' meter');
							}else{
								$('#info_modal').modal('hide');
								toastr.error('tidak ada data pada server');
							}
							mApp.unblock("#conten-info");
						},
						error : function(data){
							$('#info_modal').modal('hide');
							toastr.error('gagal mengambil data');
							mApp.unblock("#conten-info");
						}
				})
		}
	</script>
@endsection
