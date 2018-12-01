@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('css/jquery.scrolling-tabs.css') }}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="content-table-demands">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Administração de pedidos
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
                                Administração de pedidos
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <input id="current-demand" type="hidden" value="4"/>
    <div id="demands-list"></div>

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
                        <button id="status_delivery" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill active">
                            <span>
                                <i class="fa fa-shopping-cart"></i>
                                <span>
                                    Lista de entregas
                                </span>
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
                        <select class="form-control m-select2" id="filter_status_demand" name="status_demand">
                            <optgroup label="Filtre por Status">
                                @foreach($statusDemands as $status)
                                    <option value="{{$status->id}}">
                                        {{$status->description}}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                        <!--end: Search Form -->
                <!--begin: Datatable -->
                <table id="table_demands" class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap"></table>
                        <!--end: Datatable -->
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
    {{-- <script src="{{ asset('js/validation-messages-pt-br.js') }}"></script>--}}
    <script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript"></script>
    {{--    <script src="{{ asset('js/responsive.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-notify.js') }}" type="text/javascript"></script> --}}
    {{--<script src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>--}}
{{--    <script src="{{ asset('js/jquery.scrolling-tabs.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/lanchonet-main.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/jquery-aniview/dist/jquery.aniview.js"></script>
    <script src="{{ asset('js/demands.js') }}" type="text/javascript"></script>
@endpush