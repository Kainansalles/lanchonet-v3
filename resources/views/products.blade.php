@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Produtos
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#" data-toggle="modal" id="modalProdutos" data-target="#modalProdutosTarget" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
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
            <table id="table_produtos" class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap"></table>
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
                <div class="alert alert-danger" id="msg-prod" style="display:none">
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <form role="form" class="md-form" id="produtosForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_save" id="id_save" value="">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group has-feedback">
                            <label for="name">Nome</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nome"/>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price_cost">Preço de custo</label>
                                <input type="text" name="price_cost" class="form-control"
                                       id="price_cost" placeholder="R$"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price_sale">Preço de venda</label>
                                <input type="text" name="price_sale" class="form-control"
                                       id="price_sale" placeholder="R$"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8 col-sm-8 col-xs-8">
                                <input type="file" name="url_image" class="btn btn-sm float-left"
                                       id="url_image" value="" placeholder="URL da imagem"/>
                            </div>
                            <div class="col-md-4">
                                <img src="" class="img-responsive" id="imagem" alt="Foto do produto">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="validade">Validade</label>
                                <input type="date" name="validade" class="form-control"
                                       id="validade" placeholder="Validade do produto"/>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label for="quantity">Quantidade</label>
                                <input type="number" name="quantity" class="form-control"
                                       id="quantity" placeholder="Quantidade"/>
                            </div>
                        </div>

                        <div class="form-group shadow-textarea">
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrição do produto..."></textarea>
                        </div>
                        <label class="radio-inline"><input type="radio" name="status" id="ativo" value="1">Ativo</label>
                        <label class="radio-inline"><input type="radio" name="status" id="inativo" value="0">Inativo</label>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn m-btn btn-success m-btn--custom m-loader m-loader--light m-loader--right" id="salvar" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processando">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('lanchonet-js')
    {{--<script src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>--}}
    <script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/responsive.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="{{ asset('js/products.js') }}" type="text/javascript"></script>
@endpush