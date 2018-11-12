@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Usuários
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
                                Usuários
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">

            <div class="m-portlet m-portlet--mobile" id="content-table-users">
                <div class="m-portlet__body">
                    <!--begin: Datatable -->
                    <table id="table_produtos" class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap"></table>
                    <!--end: Datatable -->
                </div>
            </div>

            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                            <h3 class="m-portlet__head-text">
                                Novo usuário
                            </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="newuserform" method="POST" action="{{ url('/usuarios/novo') }}" novalidate="novalidate">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">

                                <div class="col-lg-6">
                                    <label>
                                        Nome
                                    </label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                        </div>
                                        <input type="text" name="name" class="form-control m-input" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="">
                                        Email
                                    </label>
                                    <input type="email" name="email" class="form-control m-input" >
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label class="">
                                        Senha
                                    </label>
                                    <input type="password" name="password" class="form-control m-input" >
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        Confirmar senha
                                    </label>
                                    <input type="password" name="password" class="form-control m-input" >
                                </div>
                            </div>

                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <button type="submit" class="btn btn-primary">
                                                Salvar
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>

        </div>
    </div>

@endsection

@push('lanchonet-js')
    <script src="{{ asset('js/validation-messages-pt-br.js') }}"></script>
    <script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript"></script>
    {{--    <script src="{{ asset('js/responsive.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-notify.js') }}" type="text/javascript"></script> --}}
    {{--<script src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="{{ asset('js/users.js') }}" type="text/javascript"></script>
@endpush