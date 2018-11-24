<div class="modal-content">
    <input type="hidden" id="productID" value="{{ $demand->id }}">
    <input type="hidden" id="status_demand_description" value="{{$demand->status_demand->description}}">
    <!-- Modal Header -->
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Visualização do pedido - <strong>#{{ $demand->id }}</strong>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> &times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div>
            <h2 style="text-align: center;">{{$demand->client->name}}</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5><strong>Status: {{$demand->status_demand->description}}</strong> </h5>
            </div>
            <div class="col-md-6">
                <h5><strong>Retirada:</strong> {{$demand->hour_recall}}</h5>
            </div>
        </div>
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
        <!-- Modal Footer -->
        <div class="modal-footer">
            @if ($allows_low)
                <div class="col-md-7 buttons-options" style="text-align: left;">
                    <button type="button" class="btn m-btn--pill m-btn--air btn-success btn-lg confirm_demand_product">Confirmar</button>
                    <button type="button" class="btn m-btn--pill m-btn--air btn-danger btn-lg cancel_demand_product">Cancelar</button>
                </div>
            @endif
            <div class="col-md-5">
                <h4><strong>Valor total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h4>
            </div>
        </div>
    </div>
</div>












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
                                    <i class="flaticon-placeholder-2"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Action Tools
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                            <div class="m-separator m-separator--space m-separator--dashed"></div>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                        </div>
                    </div>
                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <span class="m--margin-left-10">
                            or
                            <a href="#" class="m-link m--font-bold">
                                Cancel
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>