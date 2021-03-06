<div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Etapas dos pedidos -
                            <small>
                                Tenha cuidado ao realizar as operações!
                            </small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-status-id="4" data-toggle="tab" href="#m_tabs_5_1">
                            A fazer
                            @if ($totalPago > 0)
                                <span class="m-badge m-badge--danger" style="float: right;">{{$totalPago}}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-status-id="1" data-toggle="tab" href="#m_tabs_5_2">
                            Em preparo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-status-id="2" data-toggle="tab" href="#m_tabs_5_3">
                            Pronto p/ retirada
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-status-id="3" data-toggle="tab" href="#m_tabs_5_4">
                            Finalizados
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="m_tabs_5_1" role="tabpanel">
                        @foreach($demands as $demand)
                            @if ($demand->status_demand_id == 4)
                                <script>
                                    new mPortlet('portlets-demands-{{$demand->id}}');
                                    $("#portlets-demands-{{$demand->id}}").hide().slideDown();
                                </script>
                                <!--begin::Portlet-->
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm portlets-demands aniview" data-av-animation="slideInRight" m-portlet="true" id="portlets-demands-{{$demand->id}}">
                                    <div class="m-portlet__head" style="background-color: #282a3c; border-color:#282a3c">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon">
                                                    <i class="flaticon-user"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    {{$demand->client->name}} - <strong>#{{ $demand->id }}</strong>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <span class="m-portlet__head-icon">
                                                                <i class="flaticon-time"></i>
                                                            </span>
                                                            <h3 class="m-portlet__head-text"><strong>Retirada:</strong> {{$demand->hour_recall}}</h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-angle-down"></i>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-expand"></i>
                                                    </a>
                                                </li>--}}
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-spinner m-spinner--warning m-spinner--lg"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="m-scrollable" style="overflow:overlay; height: 150px">
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
                                                    @foreach($demand->demand_x_product as $d)
                                                        @php $perProduct = round(($d->price_registred * $d->quantity), 2);
                                                                $total = $total + $perProduct;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$d->product->name}}</td>
                                                            <td>R$ {{str_replace('.', ',', $d->price_registred) }}</td>
                                                            <td>{{$d->quantity}}</td>
                                                            <td>R$ {{str_replace('.', ',',$perProduct)}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><strong>Status:</strong> {{$demand->status_demand->description}}</h4>
                                            </div>
                                            <div class="col-md-5">
                                                <button type="button" class="btn m-btn--pill m-btn--air btn-success preparo_demand" id="{{$demand->id}}">Avançar</button>
                                                <button type="button" class="btn m-btn--pill m-btn--air btn-danger cancel_demand_panel" id="{{$demand->id}}">Cancelar</button>
                                            </div>
                                            <div class="col-md-3">
                                                <h2><strong>Total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="tab-pane" id="m_tabs_5_2" role="tabpanel">
                        @foreach($demands as $demand)
                            @if ($demand->status_demand_id == 1)
                                <script>
                                    new mPortlet('portlets-demands-{{$demand->id}}');
                                    $("#portlets-demands-{{$demand->id}}").hide().slideDown();
                                </script>
                                <!--begin::Portlet-->
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm portlets-demands" m-portlet="true" id="portlets-demands-{{$demand->id}}">
                                    <div class="m-portlet__head" style="background-color: #282a3c; border-color:#282a3c">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon">
                                                    <i class="flaticon-user"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    {{$demand->client->name}} - <strong>#{{ $demand->id }}</strong>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <span class="m-portlet__head-icon">
                                                                <i class="flaticon-time"></i>
                                                            </span>
                                                            <h3 class="m-portlet__head-text"><strong>Retirada:</strong> {{$demand->hour_recall}}</h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-angle-down"></i>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-expand"></i>
                                                    </a>
                                                </li>--}}
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-spinner m-spinner--brand m-spinner--lg"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="m-scrollable" style="overflow:overlay; height: 150px">
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
                                                    @foreach($demand->demand_x_product as $d)
                                                        @php $perProduct = round(($d->price_registred * $d->quantity), 2);
                                                                $total = $total + $perProduct;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$d->product->name}}</td>
                                                            <td>R$ {{str_replace('.', ',', $d->price_registred) }}</td>
                                                            <td>{{$d->quantity}}</td>
                                                            <td>R$ {{str_replace('.', ',',$perProduct)}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><strong>Status:</strong> {{$demand->status_demand->description}}</h4>
                                            </div>
                                            <div class="col-md-5">
                                                <a href="#" class="btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air return_demand" data-status-id="4" id="{{$demand->id}}">
                                                    <i class="fa fa-rotate-left"></i>
                                                </a>
                                                <button type="button" class="btn m-btn--pill m-btn--air btn-success retirada_demand" id="{{$demand->id}}">Avançar</button>
                                                <button type="button" class="btn m-btn--pill m-btn--air btn-danger cancel_demand_panel" id="{{$demand->id}}">Cancelar</button>
                                            </div>
                                            <div class="col-md-3">
                                                <h2><strong>Total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane" id="m_tabs_5_3" role="tabpanel">
                        @foreach($demands as $demand)
                            @if ($demand->status_demand_id == 2)
                                <script>
                                    new mPortlet('portlets-demands-{{$demand->id}}');
                                    $("#portlets-demands-{{$demand->id}}").hide().slideDown();
                                </script>
                                <!--begin::Portlet-->
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm portlets-demands" m-portlet="true" id="portlets-demands-{{$demand->id}}">
                                    <div class="m-portlet__head" style="background-color: #282a3c; border-color:#282a3c">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon">
                                                    <i class="flaticon-user"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    {{$demand->client->name}} - <strong>#{{ $demand->id }}</strong>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <span class="m-portlet__head-icon">
                                                                <i class="flaticon-time"></i>
                                                            </span>
                                                            <h3 class="m-portlet__head-text"><strong>Retirada:</strong> {{$demand->hour_recall}}</h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-angle-down"></i>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-expand"></i>
                                                    </a>
                                                </li>--}}
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-spinner m-spinner--success m-spinner--lg"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="m-scrollable" style="overflow:overlay; height: 150px">
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
                                                    @foreach($demand->demand_x_product as $d)
                                                        @php $perProduct = round(($d->price_registred * $d->quantity), 2);
                                                                $total = $total + $perProduct;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$d->product->name}}</td>
                                                            <td>R$ {{str_replace('.', ',', $d->price_registred) }}</td>
                                                            <td>{{$d->quantity}}</td>
                                                            <td>R$ {{str_replace('.', ',',$perProduct)}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><strong>Status:</strong> {{$demand->status_demand->description}}</h4>
                                            </div>
                                            <div class="col-md-5">
                                                <a href="#" class="btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air return_demand" data-status-id="1" id="{{$demand->id}}">
                                                    <i class="fa fa-rotate-left"></i>
                                                </a>
                                                <button type="button" class="btn m-btn--pill m-btn--air btn-primary confirm_demand_panel" id="{{$demand->id}}">Finalizar</button>
                                                <button type="button" class="btn m-btn--pill m-btn--air btn-danger cancel_demand_panel" id="{{$demand->id}}">Cancelar</button>
                                            </div>
                                            <div class="col-md-3">
                                                <h2><strong>Total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane" id="m_tabs_5_4" role="tabpanel">
                            @foreach($demands as $demand)
                            @if ($demand->status_demand_id == 3)
                                <script>
                                    new mPortlet('portlets-demands-{{$demand->id}}');
                                    $("#portlets-demands-{{$demand->id}}").hide().slideDown();
                                </script>
                                <!--begin::Portlet-->
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm portlets-demands" data-av-animation="slideInRight" m-portlet="true" id="portlets-demands-{{$demand->id}}">
                                    <div class="m-portlet__head" style="background-color: #282a3c; border-color:#282a3c">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon">
                                                    <i class="flaticon-user"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    {{$demand->client->name}} - <strong>#{{ $demand->id }}</strong>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <span class="m-portlet__head-icon">
                                                                <i class="flaticon-time"></i>
                                                            </span>
                                                            <h3 class="m-portlet__head-text"><strong>Retirada:</strong> {{$demand->hour_recall}}</h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-angle-down"></i>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-portlet__nav-item">
                                                    <a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                                        <i class="la la-expand"></i>
                                                    </a>
                                                </li>--}}
                                                <li class="m-portlet__nav-item">
                                                    <div class="m-spinner m-spinner m-spinner--lg"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="m-scrollable" style="overflow:overlay; height: 150px">
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
                                                    @foreach($demand->demand_x_product as $d)
                                                        @php $perProduct = round(($d->price_registred * $d->quantity), 2);
                                                                $total = $total + $perProduct;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$d->product->name}}</td>
                                                            <td>R$ {{str_replace('.', ',', $d->price_registred) }}</td>
                                                            <td>{{$d->quantity}}</td>
                                                            <td>R$ {{str_replace('.', ',',$perProduct)}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4><strong>Status:</strong> {{$demand->status_demand->description}}</h4>
                                            </div>
                                            <div class="col-md-4">
                                                <h2><strong>Total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/demands-list.js') }}" type="text/javascript"></script>