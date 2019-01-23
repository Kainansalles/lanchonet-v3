<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav">
            <!--
            <li class="m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <span class="m-menu__item-here"></span>
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text">
                        Resources
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__item-here"></span>
                                <span class="m-menu__link-text">
                                    Resources
                                </span>
                            </span>
                        </li>
                        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                            <a href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Timesheet
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Payroll
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Contacts
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ url('/') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa fa-pie-chart"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Dashboard
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ url('/admin/produtos') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa fa-briefcase"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Produtos
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ url('/admin/pedidos') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa fa-shopping-cart"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Administração de pedidos
                            </span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">
                    Configurações
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ url('/admin/configuracoes') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa fa-gear"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Estabelecimento
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ url('/admin/usuarios') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa fa-user"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Usuários
                            </span>
                        </span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>