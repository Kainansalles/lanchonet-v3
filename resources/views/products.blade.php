@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper" id="content-table-products">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Produtos
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
                                produtos
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

            <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                <small>
                                    Tenha cuidado ao realizar as operações!
                                </small>
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="modal" id="modalProdutos" data-target="#modalProdutosTarget" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-cart-plus"></i>
                                        <span>
                                            Adicionar
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            <div class="m-portlet__body">
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <table id="table_produtos" class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap"></table>
                        <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="modalProdutosTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-produtos">
                <h5 class="modal-title" id="exampleModalLabel">
                    Novo produto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" class="md-form" id="produtosForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_save" id="id_save" value="">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">
                            Nome:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="name" class="form-control m-input" id="name" placeholder="Nome" data-toggle="m-tooltip" title="Informe o nome do produto"/>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-lg-6 col-form-label">
                                Preço de custo:
                            </label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" name="price_cost" class="form-control m-input" id="price_cost" placeholder="R$"/>
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-calculator"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-lg-6 col-form-label">
                                Preço de venda:
                            </label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" name="price_sale" class="form-control m-input" id="price_sale" placeholder="R$"/>
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-calculator"></i>
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="url_image" id="url_image">
                                <label class="custom-file-label" for="customFile">
                                    Escolha um arquivo
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                            <img src="" class="img-responsive" id="imagem" alt="Foto do produto">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-lg-6 col-form-label">
                                Validade:
                            </label>
                            <div class="input-group date" >
                                <input type="date" class="form-control m-input" name="validade" id="validade"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-lg-6 col-form-label">
                                Quantidade:
                            </label>
                            <div class="input-group date" >
                                <input type="number" class="form-control m-input" id="quantity" name="quantity" value="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calculator"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Descrição
                        </label>
                        <div class="col-lg-12">
                            <textarea class="form-control m-input" name="description" id="description" name="description" rows="3" placeholder="Descrição do produto.."></textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>
                                Status
                            </label>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="status" id="ativo" value="1">
                                    Ativo
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="status" id="ativo" value="0">
                                    Inativo
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="{{ asset('js/products.js') }}" type="text/javascript"></script>
@endpush