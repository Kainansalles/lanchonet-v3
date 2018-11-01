@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{--<link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" />--}}
@endpush

@section('content')

<div class="m-portlet m-portlet--mobile" id="content-table-demands" style="width: 100%;">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Administração de pedidos
                </h3>
            </div>
        </div>
        {{--<div class="m-portlet__head-tools">--}}
            {{--<ul class="m-portlet__nav">--}}
                {{--<li class="m-portlet__nav-item">--}}
                    {{--<a href="#" data-toggle="modal" id="modalProdutos" data-target="#modalProdutosTarget" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">--}}
                        {{--<span>--}}
                            {{--<i class="la la-cart-plus"></i>--}}
                            {{--<span>--}}
                                {{--Adicionar--}}
                            {{--</span>--}}
                        {{--</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    </div>
    <div class="m-portlet__body">
        <table id="table_demands" class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap"></table>
    </div>
</div>

<div class="modal fade" id="modalDemandTarget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="content-modal" role="document">

    </div>
</div>

@endsection

@push('lanchonet-js')
    {{--<script src="{{ asset('js/validation-messages-pt-br.js') }}"></script>--}}
    <script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript"></script>
    {{--    <script src="{{ asset('js/responsive.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/bootstrap-notify.js') }}" type="text/javascript"></script> --}}
    {{--<script src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>--}}
    <script src="{{ asset('js/demands.js') }}" type="text/javascript"></script>
@endpush