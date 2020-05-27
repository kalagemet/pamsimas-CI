<!-- BEGIN: Header -->
<header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200" >
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">
            @include('admin.layout.brand')
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <div id="m_header_menu" align="center" class="m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                    &nbsp;
                    <h2 class="m--font-boldest m--font-transform-u m--font-brand">Sistem Informasi Pamsimas</h2>
                    <!-- <h6 class="m--font-accent">Penyediaan Air Minum dan Sanitasi Berbasis Masyarakat</h6> -->
                    <!-- m-header-menu m-aside-header-menu-mobile -->
                </div>	
            </div>
            <!-- BEGIN: Toopbar -->
            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                <div class="m-stack__item m-topbar__nav-wrapper">
                    <ul class="m-topbar__nav m-nav m-nav--inline">
                        <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                <span class="m-topbar__userpic">
                                    <img class="m--img-rounded m--marginless m--img-centered" width="70px" onerror=this.src="{{asset('assets/src/media/app/img/users/100_1.jpg')}}" src="/cabang/get_logo">
                                </span>
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__header m--align-center" style="background: linear-gradient(#8729e5, #5777f9); background-size: cover;">
                                        <div class="m-card-user m-card-user--skin-dark">
                                            <div class="m-card-user__details">
                                                <span class="m-card-user__name m--font-weight-500 m--font-transform-u">
                                                    {{$user->id}} - {{$user->nama_cabang}}
                                                </span>
                                                <span class="m-card-user__email m--font-weight-300">
                                                    Desa {{ucfirst(strtolower($user->lokasi))}} | {{$user->id_admin}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav m-nav--skin-light">
                                                <li class="m-nav__section m--hide">
                                                    <span class="m-nav__section-text">
                                                        Section
                                                    </span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="/cabang/profil" class="m-nav__link">
                                                        <i class="m-nav__link-icon fa fa-user"></i>
                                                        <span class="m-nav__link-title">
                                                            <span class="m-nav__link-wrap">
                                                                <span class="m-nav__link-text">
                                                                    Profil
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a id="m_sweetalert_logout" href="#" class="m-nav__link">
                                                        <i class="m-nav__link-icon fa fa-power-off"></i>
                                                        <span class="m-nav__link-text">
                                                            Keluar
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- END:toopbar -->
        </div>
    </div>
</header>
<!-- end: header -->
