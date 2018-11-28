<div class="m-content">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Etapas dos pedidos
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-pills nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab" href="#m_tabs_5_1">
                        A fazer
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#m_tabs_5_2">
                        Em preparo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#m_tabs_5_3">
                        Pronto p/ retirada
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#m_tabs_5_4">
                        Finalizado
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="m_tabs_5_1" role="tabpanel">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div class="tab-pane" id="m_tabs_5_2" role="tabpanel">
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div class="tab-pane" id="m_tabs_5_3" role="tabpanel">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                </div>
                <div class="tab-pane" id="m_tabs_5_4" role="tabpanel">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($demands as $demand)
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm portlets-demands" m-portlet="true" id="portlets-demands-{{$demand->id}}">
                    <div class="m-portlet__head" style="background-color: #282a3c; border-color:#282a3c">
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
                            {{--<ul class="m-portlet__nav">--}}
                                {{--<li class="m-portlet__nav-item">--}}
                                    {{--<button type="button" class="btn m-btn--pill m-btn--air btn-danger cancel_demand" id="{{$demand->id}}">Cancelar pedido</button>--}}
                                {{--</li>--}}
                                {{--<li class="m-portlet__nav-item">--}}
                                    {{--<div class="m-spinner m-spinner--warning m-spinner--lg"></div>--}}
                                {{--</li>--}}
                                {{--<li class="m-portlet__nav-item">--}}
                                    {{--<div class="m-spinner m-spinner--success m-spinner--lg"></div>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                        <i class="la la-angle-down"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a href="#"  m-portlet-tool="reload" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                        <i class="la la-refresh"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                        <i class="la la-expand"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                        <i class="la la-close"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Status:</strong> {{$demand->status_demand->description}}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Retirada:</strong> {{$demand->hour_recall}}</h6>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" class="btn m-btn--pill m-btn--air btn-success retirada_demand" id="{{$demand->id}}">Em reparo</button>
                                <button type="button" class="btn m-btn--pill m-btn--air btn-info preparo_demand" id="{{$demand->id}}">P/ Retirada</button>
                            </div>
                            <div class="col-md-4">
                                <h5><strong>Total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // $(document).ready(function(){
                    new mPortlet('portlets-demands-{{$demand->id}}')
                // });
            </script>
        @endforeach
    </div>
</div>