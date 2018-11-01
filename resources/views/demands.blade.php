@extends('layouts.app')

@push('lanchonet-css')
    <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/lanchonet.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper content-table-demands">
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
                    <label class="col-form-label col-lg-3 col-sm-12">
                        Multi Select
                    </label>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        <select class="form-control m-select2" id="m_select2_3" name="param" multiple="multiple">
                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                <option value="AK" selected>
                                    Alaska
                                </option>
                                <option value="HI">
                                    Hawaii
                                </option>
                            </optgroup>
                            <optgroup label="Pacific Time Zone">
                                <option value="CA">
                                    California
                                </option>
                                <option value="NV" selected>
                                    Nevada
                                </option>
                                <option value="OR">
                                    Oregon
                                </option>
                                <option value="WA">
                                    Washington
                                </option>
                            </optgroup>
                            <optgroup label="Mountain Time Zone">
                                <option value="AZ">
                                    Arizona
                                </option>
                                <option value="CO">
                                    Colorado
                                </option>
                                <option value="ID">
                                    Idaho
                                </option>
                                <option value="MT" selected>
                                    Montana
                                </option>
                                <option value="NE">
                                    Nebraska
                                </option>
                                <option value="NM">
                                    New Mexico
                                </option>
                                <option value="ND">
                                    North Dakota
                                </option>
                                <option value="UT">
                                    Utah
                                </option>
                                <option value="WY">
                                    Wyoming
                                </option>
                            </optgroup>
                            <optgroup label="Central Time Zone">
                                <option value="AL">
                                    Alabama
                                </option>
                                <option value="AR">
                                    Arkansas
                                </option>
                                <option value="IL">
                                    Illinois
                                </option>
                                <option value="IA">
                                    Iowa
                                </option>
                                <option value="KS">
                                    Kansas
                                </option>
                                <option value="KY">
                                    Kentucky
                                </option>
                                <option value="LA">
                                    Louisiana
                                </option>
                                <option value="MN">
                                    Minnesota
                                </option>
                                <option value="MS">
                                    Mississippi
                                </option>
                                <option value="MO">
                                    Missouri
                                </option>
                                <option value="OK">
                                    Oklahoma
                                </option>
                                <option value="SD">
                                    South Dakota
                                </option>
                                <option value="TX">
                                    Texas
                                </option>
                                <option value="TN">
                                    Tennessee
                                </option>
                                <option value="WI">
                                    Wisconsin
                                </option>
                            </optgroup>
                            <optgroup label="Eastern Time Zone">
                                <option value="CT">
                                    Connecticut
                                </option>
                                <option value="DE">
                                    Delaware
                                </option>
                                <option value="FL">
                                    Florida
                                </option>
                                <option value="GA">
                                    Georgia
                                </option>
                                <option value="IN">
                                    Indiana
                                </option>
                                <option value="ME">
                                    Maine
                                </option>
                                <option value="MD">
                                    Maryland
                                </option>
                                <option value="MA">
                                    Massachusetts
                                </option>
                                <option value="MI">
                                    Michigan
                                </option>
                                <option value="NH">
                                    New Hampshire
                                </option>
                                <option value="NJ">
                                    New Jersey
                                </option>
                                <option value="NY">
                                    New York
                                </option>
                                <option value="NC">
                                    North Carolina
                                </option>
                                <option value="OH">
                                    Ohio
                                </option>
                                <option value="PA">
                                    Pennsylvania
                                </option>
                                <option value="RI">
                                    Rhode Island
                                </option>
                                <option value="SC">
                                    South Carolina
                                </option>
                                <option value="VT">
                                    Vermont
                                </option>
                                <option value="VA">
                                    Virginia
                                </option>
                                <option value="WV">
                                    West Virginia
                                </option>
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