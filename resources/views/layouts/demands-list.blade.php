<div class="m-content">
    <div class="row">
        @foreach($demands as $demand)
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
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
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <div class="m-spinner m-spinner--warning m-spinner--lg"></div>
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
                            <button type="button" class="btn m-btn--pill m-btn--air btn-success confirm_demand" id="{{$demand->id}}">Confirmar</button>
                                {{-- <button type="button" class="btn m-btn--pill m-btn--air btn-danger cancel_demand_product">Cancelar</button> --}}
                                <span class="m--margin-left-10">
                                    ou
                                    <a href="#" class="m-link m--font-bold cancel_demand" id="{{$demand->id}}">
                                        Cancelar
                                    </a>
                                </span>
                            </div>
                            <div class="col-md-4">
                                <h5><strong>Total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>