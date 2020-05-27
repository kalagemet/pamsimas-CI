<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
<!-- BEGIN: Aside Menu -->
<div 
    id="m_ver_menu" 
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
    m-menu-vertical="1"
    m-menu-scrollable="1" m-menu-dropdown-timeout="500"  
    >
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <div  href="jdjdjd" class="m-menu__link m-menu__toggle">
                <span class="m-menu__link-text">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            <div class="m-stack m-stack--hor m-stack--general">
								<div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                    <img class="m--img-rounded" width="70px" onerror=this.src="{{asset('assets/src/media/app/img/users/100_1.jpg')}}" src="/admin/get_pic">
                                </div>
								<div class="m-stack__item m-stack__item--center m-stack__item--middle m-stack__item--fluid">
									<div class="m-stack__demo-item">
                                        <br/><h5><span class="m--font-transform-u">{{$user->nama}} - {{$user->id}}</span></h5>
                                    </div>
								</div>
								<div class="m-stack__item m-stack__item--center m-stack__item--middle">
									<div class="m-stack__demo-item">
										<h6>Desa {{ucfirst(strtolower($user->lokasi))}}</h6>
                                    </div>
								</div>
							</div>
                        </span>
                    </span>
                </span>
            </div>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="/admin/profil_ubah" class="m-menu__link ">
                            <i class="m-menu__link-icon fa fa-pencil"></i>
                            <span class="m-menu__link-text">Edit Profil Admin</span>
                        </a>
                    </li>
                </ul>
                <br/>
            </div>
        </li>
        <br/>
        <li class="m-menu__item" aria-haspopup="true" >
            <a  href="/" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-tv"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Dashboard
                        </span>
                        <!-- <span class="m-menu__link-badge">
                            <span class="m-badge m-badge--danger">
                                1
                            </span>
                        </span> -->
                    </span>
                </span>
            </a>
        </li>
        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Akun Cabang
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a  href="/admin/daftar_cabang" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-group"></i>
                <span class="m-menu__link-text">
                    Daftar Cabang
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-file-text"></i>
                <span class="m-menu__link-text">
                    Laporan Keuangan
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="/admin/pembukuan" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Pembukuan
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Sistem
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-list-alt"></i>
                <span class="m-menu__link-text">
                    Riwayat / Log
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="/admin/log_admin" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Log Admin
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true" >
                        <a  href="/admin/log_cabang" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Log Cabang
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Akun
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a  id="m_sweetalert_logout" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon fa fa-power-off"></i>
                <span class="m-menu__link-text">
                    Keluar
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
        </li>
    </ul>
</div>