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
                    Configurações
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
                                Estabelecimento
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Configurações do estabelecimento
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="configuracoesForm" method="POST" action="/admin/configuracoes/editar/<?= $estabelecimento->id?>">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>
                                Razão social
                            </label>
                            <div class="input-group m-input-group m-input-group--square">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                </div>
                                <input type="text" name="company_name" class="form-control m-input" value="<?=$estabelecimento->company_name?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Nome fantasia
                            </label>
                            <input type="text" name="nickname" class="form-control m-input" value="<?=$estabelecimento->nickname?>">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                CNPJ
                            </label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" name="cnpj" id="cnpj" class="form-control m-input" value="<?=$estabelecimento->cnpj?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label class="">
                                CEP
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" name="cep" id="cep" class="form-control m-input" value="<?=$estabelecimento->cep?>">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-map-marker"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Bairro
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" name="neighborhood" class="form-control m-input" value="<?=$estabelecimento->neighborhood?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Rua
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" name="street" class="form-control m-input" value="<?=$estabelecimento->street?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label class="">
                                UF
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" name="uf" class="form-control m-input" value="<?=$estabelecimento->uf?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Número
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" name="number" class="form-control m-input" value="<?=$estabelecimento->number?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Telefone
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" name="telephone" id="telephone" class="form-control m-input" value="<?=$estabelecimento->telephone?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>
                                Conta bancária
                            </label>
                            <input type="text" name="bank_account" id="bank_account" class="form-control m-input" value="<?=$estabelecimento->bank_account?>">
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Agência bancária
                            </label>
                            <input type="text" name="bank_agency" id="bank_agency" class="form-control m-input" value="<?=$estabelecimento->bank_agency?>">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-3">
                            <label>
                                Horário de abertura
                            </label>
                            <input type="time" name="open_hours" class="form-control m-input" value="<?=$estabelecimento->open_hours?>">
                        </div>
                        <div class="col-lg-3">
                            <label>
                                Hórario fechamento
                            </label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="time" name="close_hours" class="form-control m-input" value="<?=$estabelecimento->close_hours?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="">
                                Tempo minimo de retirada
                            </label>
                            <input type="time" name="minutes_min_recall" class="form-control m-input" value="<?=$estabelecimento->minutes_min_recall?>">
                        </div>
                        <div class="col-lg-3">
                            <label>
                                Dias de funcionamento
                            </label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" name="works_days" class="form-control m-input" value="<?=$estabelecimento->works_days?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>

@endsection

@push('lanchonet-js')
    <script src="{{ asset('js/validation-messages-pt-br.js') }}"></script>
    {{--    <script src="{{ asset('js/responsive.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-notify.js') }}" type="text/javascript"></script> --}}
    {{--<script src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="{{ asset('js/config.js') }}" type="text/javascript"></script>
@endpush