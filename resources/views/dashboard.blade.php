@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="content-table-demands">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Dashboard
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">
                                dashboard
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <!--end: Search Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Faturamento mensal
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div id="chartdivDemandsxProducts"></div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Pedidos
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div id="chartdivDemands"></div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Mais vendidos
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div id="chartdivProducts"></div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                </div>


                <style>
                    #chartdivDemandsxProducts, #chartdivDemands, #chartdivProducts {
                        width	: 100%;
                        height	: 400px;
                    }
                </style>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDemandTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="content-modal" role="document">
    </div>
</div>

@endsection

@push('lanchonet-js')
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/dataviz.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>
@endpush