@extends('cabang.layout.master')
@section('title', 'Detail Tagihan | Sistem Informasi Pamsimas')
@section('content')
    <!-- BEGIN:isi -->
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator m--font-metal">
                        Data Pelanggan
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item">
                            <i class="m-nav__link-icon fa fa-history m--font-metal"></i>
                        </li>
                        <li class="m-nav__separator m--font-metal">
                            -
                        </li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">
                                <span class="m-section__sub m--font-info">Dibuat pada : {{$data->created_at}}</span> - 
                                <span class="m--font-warning">Terakhir diperbarui : {{$data->updated_at}} </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END:subheader -->
        {{-- BEGIN:content --}}
        <div class="m-content">
			<div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
				<div class="m-alert__icon">
					<i class="flaticon-exclamation m--font-warning"></i>
				</div>
				<div class="m-alert__text">
                Halaman ini menampilkan semua data pelanggan <b>{{ucfirst(strtolower($data->nama))}} ({{$data->id}})</b> dari Pamsimas {{ucfirst(strtolower($user->nama_cabang))}}, harap berhati-hati dalam perubahan.
				</div>
			</div>
			<div class="m-portlet m-portlet--mobile">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Daftar Tagihan <b>{{ucfirst(strtolower($data->nama))}}</b> | {{ucfirst(strtolower($data->alamat))}}
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body"  id="m_pelanggan_content">
                    {{-- Begin:search --}}
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                
                            </div>
                            <div class="col-xl-2 order-2 order-xl-2 m--align-right">
                                <span>Tahun:</span>
                                {{-- //search --}}
                            </div>
                            <div class="col-xl-2 order-1 order-xl-2 m--align-right">
                                <select required name="tahun" id="tahun" class="form-control m-input m--font-transform-u">
                                    @for ($year=$tahun_rilis; $year <= date('Y'); $year++)
                                        <option @if($year==$tahun_ini) selected @endif value="{{$year}}">{{$year}}</option>
                                    @endfor
                                </select>
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
									<th title="Field #2" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
										Bulan
									</span></th>
									<th title="Field #3" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Status Tagihan
									</span></th>
									<th title="Field #4" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Jumlah Meter
									</span></th>
									<th title="Field #5" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">
										Status Pembayaran
									</span></th>
									<th title="Field #6" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
										Tarif /m
									</span></th>
									<th title="Field #7" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
										Total
									</span></th>
									<th title="Field #8" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">
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
                </div>
            </div>
            <!-- BEGIN:modal -->
            <!-- END:modal -->
        </div>
        {{-- END: content --}}
    </div>
    {{-- END:isi --}}
@endsection
@section('script')
<script type="text/javascript">
    // $(document).ready(function(){
        tampil_tagihan(`{{url('/cabang/get_tagihanall?id_pel=').$data->id}}&tahun=`,{{$tahun_ini}});   //pemanggilan fungsi tampil barang.
        
        // $('#html_table').mDatatable();
        
        // fungsi tampil barang
        function tampil_tagihan(page, thn){
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
                    var status= '';
                    var jml= '';
                    var lunas= '';
                    var tarif= '';
                    var total= '';
                    if(data.length==0){
                        html += '<div class="m-stack m-stack--ver m-stack--general m-stack--demo">'+
                                    '<div class="m-stack__item m-stack__item--center m-stack__item--middle">'+
                                        '<span class="m-datatable--error">Tidak ada data untuk ditampilkan</span>'+
                                    '</div>'+
                                '</div>'
                    }else{
                        var tmp = '-';
                        var aksi = ''; 
                        for(i=0; i<data.length; i++){
                            if(data[i].data[0]!=null){
                                status = '<span class="m-badge m-badge--brand m-badge--wide">Sudah</span>';
                                jml = '<span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">'+data[i].data[0].jml_meter+' Meter</span>';
                                lunas = data[i].data[0].lunas;
                                if(lunas == 1){
                                    lunas = '<span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">Lunas</span>';
                                    //tagihan sudah terbayar
                                    aksi = '<span style="width: 150px;"><span class="m-badge m-badge--success m-badge--wide">Terbayar</span></span>';
                                }else{
                                    lunas = '<span class="m-badge m-badge--warning m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-warning">Belum Lunas</span>';
                                    //cek tahun sekarang
                                    if(thn=={{$tahun_ini}}){
                                        //tagihan belum terbayar
                                        aksi = '<span style="overflow: visible; position: relative; width: 150px;"><div class="input-group">'+
                                                    '<input onkeyPress="return angka(event)" id="form_'+(data[i].bulan+1)+'" type="text" maxlength="4" value="'+data[i].data[0].jml_meter+'" class="form-control m-input" placeholder="Meter">'+
                                                    '<div class="input-group-append">'+
                                                        '<a href="javascript:void(0)" onClick="update_tagihan('+(data[i].bulan+1)+','+data[i].data[0].id+','+data[i].data[0].jml_meter+')" class="btn btn-warning">'+
                                                            '<i class="fa fa-save"></i>'+
                                                        '</a>'+
                                                    '</div>'+
                                                '</div></span>';
                                    }else{
                                        aksi = '<span style="width: 150px;"><span class="m-badge m-badge--warning m-badge--wide">tidak tersedia</span></span>';
                                    }
                                }
                                tarif = data[i].data[0].tarif;
                                total = data[i].data[0].total;
                                //status sudah terbayar

                            }else{
                                status = '<span class="m-badge m-badge--danger m-badge--wide">Belum</span>';
                                jml = '<span class="m--font-bold m--font-primary">0</span>';
                                lunas = '<span class="m--font-bold m--font-danger">Tidak tersedia</span>';
                                tarif = '<div id="tarif_tag" class="m--font-metal">'+tmp+'</div>';
                                total = '';
                                //cek tahun sekarang
                                if(thn=={{$tahun_ini}}){
                                    //tagihan belum diinputkan
                                    aksi = '<span style="overflow: visible; position: relative; width: 150px;"><div class="input-group">'+
                                                '<input onkeyPress="return angka(event)" id="form_'+(data[i].bulan+1)+'" type="text" maxlength="4" class="form-control m-input" placeholder="Meter">'+
                                                '<div class="input-group-append">'+
                                                    '<a href="javascript:void(0)" onClick="input_tagihan('+{{$data->id}}+','+(data[i].bulan+1)+')" class="btn btn-brand">'+
                                                        '<i class="fa fa-plus-circle"></i>'+
                                                    '</a>'+
                                                '</div>'+
                                            '</div></span>';
                                }else{
                                    aksi = '<span style="width: 150px;"><span class="m-badge m-badge--warning m-badge--wide">tidak tersedia</span></span>';
                                }
                            }
                            html += '<tr data-row="0" class="m-datatable__row" style="left: 0px;">'+
                                        '<td data-field="No" class="m-datatable__cell">'+
                                            '<span style="width: 30px;">'+(i+1)+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #2" class="m-datatable__cell m--font-transform-u">'+
                                            '<span style="width: 150px;">'+echoBulan(data[i].bulan+1)+' '+thn+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #3" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+status+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #4" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+jml+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #5" class="m-datatable__cell">'+
                                            '<span style="width: 100px;">'+lunas+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #6" class="m-datatable__cell">'+
                                            '<span style="width: 150px;">'+formatRupiah(tarif,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #7" class="m-datatable__cell">'+
                                            '<span style="width: 150px;">'+formatRupiah(total,"Rp. ")+'</span>'+
                                        '</td>'+
                                        '<td data-field="Field #8" class="m-datatable__cell">'+
                                            aksi+
                                        '</td>'+
                                    '</tr>';  
                        }
                    }
                    $('#show_data').html(html); 
                    mApp.unblock("#html_table");  
                }
            });
        }
    // });
</script>
<script type="text/javascript">
    $('#tahun').on('change', function(e){
        var th = e.target.value;
        tampil_tagihan(`{{url('/cabang/get_tagihanall?id_pel=').$data->id}}&tahun=`,th); 
    });
</script>
<script type="text/javascript" src="{{asset('assets/js/bulan.js')}}"></script>
{{-- //input tagihan --}}
<script type="text/javascript">
    function input_tagihan(id,bulan){
        var meter = document.getElementById('form_'+bulan);
        if(meter.value==null || meter.value == ''){
            meter.focus();
            return false;
        }else{
            mApp.block("#html_table",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            $.ajax({
                type  		: 'POST',
                url   		: "{{url('/cabang/input_tagihan2')}}",
                data        : {
                    "_token": "{{ csrf_token() }}" ,
                    'jml_meter' : meter.value,
                    'id_pelanggan': id,
                    'bulan' : bulan
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // async 		: true,
                // dataType 	: 'json',
                success : function(data){
                    if(data.status=='success'){
                        toastr.success(data.message);
                        tampil_tagihan(`{{url('/cabang/get_tagihanall?id_pel=').$data->id}}&tahun=`,{{$tahun_ini}})
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
{{-- update tagihan --}}
<script type="text/javascript">
    function update_tagihan(id_form,id_tag,meter_sebelumnya){
        var meter = document.getElementById('form_'+id_form);
        if(meter.value==null || meter.value == '' || meter.value==meter_sebelumnya){
            meter.focus();
            return false;
        }else{
            mApp.block("#html_table",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            $.ajax({
                type  		: 'POST',
                url   		: "{{url('/cabang/update_tagihan')}}",
                data        : {
                    "_token": "{{ csrf_token() }}" ,
                    'jml_meter' : meter.value,
                    'id_tagihan': id_tag,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // async 		: true,
                // dataType 	: 'json',
                success : function(data){
                    if(data.status=='success'){
                        toastr.success(data.message);
                        tampil_tagihan(`{{url('/cabang/get_tagihanall?id_pel=').$data->id}}&tahun=`,{{$tahun_ini}})
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
@endsection