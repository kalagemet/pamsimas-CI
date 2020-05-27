@extends('admin.layout.master')

@section('title','Ubah Profil Admin | Sistem Informasi Pamsimas')
@section('content')
    <!-- BEGIN:isi -->
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator m--font-metal">
                        Admin Profil
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
                                <span class="m-section__sub m--font-info">Dibuat pada : {{$user->created_at}}</span> - 
                                <span class="m--font-warning">Terakhir diperbarui : {{$user->updated_at}} </span>
                            </span>
                        </li>
                    </ul>
                </div>

                    <div>
                        <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                            <span class="m-subheader__daterange-label">
                                <span class="m-subheader__daterange-title">ID : </span>
                                <span class="m-subheader__daterange-date m--font-brand">{{$user->id}}</span>
                            </span>
                            <span class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                <i class="fa fa-bell-o"></i>
                            </span>
                        </span>
                    </div>

            </div>
        </div>
        <!-- END:subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Begin:portlet -->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Data Lokasi
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form" name="pilih_lokasi" id="pilih_lokasi" action="admin.ubah_lokasi" method="post">
                            {{ csrf_field() }}
                            <div class="m-portlet__body" id="m_lokasi_content">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Provinsi
                                        </label>
                                        <div class="col-lg-6">
                                            <select required name="provinsi" id="provinsi" class="form-control m-input m--font-transform-u">
                                                @foreach($prov as $a)
                                                <option 
                                                    @if($user->propinsi==$a->id)
                                                        selected
                                                    @endif
                                                    value="{{$a->id}}">{{$a->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Kabupaten / Kota
                                        </label>
                                        <div class="col-lg-6">
                                            <select required name="kabupaten" id="kabupaten" class="form-control m-input m--font-transform-u">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Kecamatan 
                                        </label>
                                        <div class="col-lg-6">
                                            <select required name="kecamatan" id="kecamatan" class="form-control m-input m--font-transform-u">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Desa
                                        </label>
                                        <div class="col-lg-6">
                                            <select required name="desa" id="desa" class="form-control m-input m--font-transform-u">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <button type="Submit" class="btn btn-success">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!-- End:portlet -->
                </div>
                <div class="col-lg-4">
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Autentikasi Login Admin 
                                    </h3>
                                </div>
                            </div>
                        </div><br/>
                        <div class="m-stack m-stack--hor m-stack--general">
                            <div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                <div class="m-stack__item">
                                    <img class="m--img-rounded m--marginless m--img-centered" width="150px" onerror=this.src="{{asset('assets/src/media/app/img/users/100_1.jpg')}}" src="/admin/get_pic">
                                </div><br/>
                                <div class="m-stack__item">
                                    <button type="button" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" data-toggle="modal" data-target="#ganti_gambar_modal">
                                        <span>
                                            <i class="fa fa-pencil"></i>
                                            <span>
                                                Ubah Gambar
                                            </span>
                                        </span>
                                    </button>
                                </div>
                                <br/>
                                <div class="m-stack__item">
                                    <button type="button" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air"  data-toggle="modal" data-target="#ganti_password_modal">
                                        <span>
                                            <i class="fa fa-key"></i>
                                            <span>
                                                Ubah Password
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form" action="admin.ubah_username" method="post">
                            {{ csrf_field()}}
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group">
                                        <label for="example_input_full_name">
                                            Username:
                                        </label>
                                        <input name="nama" id="m_maxlength_1" maxlength="25" required type="text" class="form-control m-input" value="{{$user->nama}}" placeholder="Username">
                                        <span class="m-form__help">
                                            Ini digunakan untuk login pada sistem
                                        </span>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>
                                            NIK:
                                        </label>
                                        <input onkeyPress="return angka(event)" id="m_maxlength_6_4" minlength="16" maxlength="16" name="nik" type="text" required value="{{$user->nik}}" class="form-control m-input" placeholder="Nomor Induk Kependudukan">
                                        <span class="m-form__help">
                                            Tidak akan di tampilkan pada sistem
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
                <!-- BEGIN:modal -->
                <div class="modal fade" id="ganti_gambar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right" action="admin.ubah_pic" method="post" enctype="multipart/form-data"> 
                                {{ csrf_field()}}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                        Unggah Gambar/Logo Profil
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            ×
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group m-form__group">
                                        <div class="custom-file">
                                            <input required accept="image/jpeg,image/jpg" type="file" name="image" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">
                                                Choose file
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END:modal -->
                <!-- BEGIN:modal -->
                <div class="modal fade" id="ganti_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right" action="admin.ubah_pas" method="post"> 
                                {{ csrf_field()}}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                        Perbarui password
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            ×
                                        </span>
                                    </button>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="pass">
                                        Password baru
                                    </label>
                                    <input id="m_maxlength_6_4" minlength="6" name="pass" required type="password" class="form-control m-input" placeholder="Password">
                                    <label for="pass2">
                                        Konfirmasi Password baru
                                    </label>
                                    <input id="m_maxlength_6_4" minlength="6" name="pass_confirmation" required  type="password" class="form-control m-input" placeholder="Password">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="curpass">
                                        Password saat ini
                                    </label>
                                    <input name="current-password" required  type="password" class="form-control m-input" id="curpass" placeholder="Password">
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
    </div>
    <!-- END:isi -->
@endsection
@section('script')
    <script src="{{asset('assets/demo/default/custom/components/forms/widgets/select2.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        mApp.block("#m_lokasi_content",{
            overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
        }),

        $.get('{{url('/get_kab?state_id=')}}' +{{$user->propinsi}}, function(data){
            $('#kabupaten').empty();
            $.each(data.cities, function(index,subCatObj){
                var B = (subCatObj.id =={{$user->kabupaten}}) ? "selected ":"";
                $('#kabupaten').append('<option '+ B +'value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
            });
        });
        $.get('{{url('/get_kec?kab_id=')}}' + {{$user->kabupaten}}, function(data) {
            $('#kecamatan').empty();
            $.each(data.districts, function(index,subCatObj){
                var B = (subCatObj.id =={{$user->kecamatan}}) ? "selected ":"";
                $('#kecamatan').append('<option '+B+'value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
            });
        });
        $.get('{{url('/get_desa?kec_id=')}}' + {{$user->kecamatan}}, function(data) {
            $('#desa').empty();
            $.each(data.villages, function(index,subCatObj){
                var B = (subCatObj.id =={{$user->desa}}) ? "selected ":"";
                $('#desa').append('<option '+B+' value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
                mApp.unblock("#m_lokasi_content");
            });
        });

        $('#provinsi').on('change', function(e){
            mApp.block("#m_lokasi_content",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            var state_id = e.target.value;
            $('#kecamatan').empty();
            $('#desa').empty();
            $.get('{{url('/get_kab?state_id=')}}' +state_id, function(data) {
                $('#kabupaten').empty();
                $.each(data.cities, function(index,subCatObj){
                    $('#kabupaten').append('<option  value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
                    mApp.unblock("#m_lokasi_content");
                });
            });
        });

        $('#kabupaten').on('change', function(e){
            mApp.block("#m_lokasi_content",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            var state_id = e.target.value;
            $('#desa').empty();
            $.get('{{url('/get_kec?kab_id=')}}' + state_id, function(data) {
                $('#kecamatan').empty();
                $.each(data.districts, function(index,subCatObj){
                    $('#kecamatan').append('<option value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
                    mApp.unblock("#m_lokasi_content");
                });
            });
        });

        $('#kecamatan').on('change', function(e){
            mApp.block("#m_lokasi_content",{
                overlayColor:"#000000",type:"loader",state:"success",message:"Mohon Tunggu..."
            });
            var state_id = e.target.value;

            $.get('{{url('/get_desa?kec_id=')}}' + state_id, function(data) {
                $('#desa').empty();
                $.each(data.villages, function(index,subCatObj){
                    $('#desa').append('<option value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
                    mApp.unblock("#m_lokasi_content");
                });
            });
        });
    </script>

    <script src="{{asset('assets/demo/default/custom/components/forms/widgets/bootstrap-maxlength.js')}}" type="text/javascript"></script>
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
        toastr.success('Perubahan berhasil disimpan');
    </script>
    @endif
    @if(Session::has('error'))
    <script type="text/javascript">
        toastr.error("{{Session::get('error')}}");
    </script>
    @endif
@endsection

