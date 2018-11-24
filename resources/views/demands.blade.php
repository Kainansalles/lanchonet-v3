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

    <!-- Aqui vem a parada-->
    <div id="demands-list">
    <div class="m-content">
            <div class="row">

                @foreach($demands as $demand)
                    <div class="col-lg-6">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-time"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            {{$demand->client->name}} - <strong>#{{ $demand->id }}</strong>
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                <i class="la la-angle-down"></i>
                                            </a>
                                        </li>
                                        <li class="m-portlet__nav-item">
                                            <a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                <i class="la la-expand"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="150" style="overflow:hidden; height: 150px">
                                    <table class="table m-table m-table--head-bg-brand">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Valor</th>
                                            <th>Quantidade</th>
                                            <th>Por produto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $perProduct = 0; $total = 0; @endphp
                                            @foreach($demand->demand_x_product as $demand)
                                                @php $perProduct = round(($demand->price_registred * $demand->quantity), 2);
                                                        $total = $total + $perProduct;
                                                @endphp
                                                <tr>
                                                    <td>{{$demand->product->name}}</td>
                                                    <td>R$ {{str_replace('.', ',', $demand->price_registred) }}</td>
                                                    <td>{{$demand->quantity}}</td>
                                                    <td>R$ {{str_replace('.', ',',$perProduct)}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="m-portlet__foot">
                                <button type="button" class="btn m-btn--pill m-btn--air btn-success confirm_demand_product">Confirmar</button>
                                {{-- <button type="button" class="btn m-btn--pill m-btn--air btn-danger cancel_demand_product">Cancelar</button> --}}
                                <span class="m--margin-left-10">
                                    ou
                                    <a href="#" class="m-link m--font-bold">
                                        Cancelar
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

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
            </div>
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
    <script src="{{ asset('js/demands.js') }}" type="text/javascript"></script>
@endpush