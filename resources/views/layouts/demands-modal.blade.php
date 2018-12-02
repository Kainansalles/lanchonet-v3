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
            {{-- @if ($allows_low)
                <div class="col-md-7 buttons-options" style="text-align: left;">
                    <button type="button" class="btn m-btn--pill m-btn--air btn-success btn-lg confirm_demand_product">Confirmar</button>
                    <button type="button" class="btn m-btn--pill m-btn--air btn-danger btn-lg cancel_demand_product">Cancelar</button>
                </div>
            @endif--}}
            <div class="col-md-5 offset-md-7">
                <h4><strong>Valor total:</strong> R$ {{str_replace('.', ',', round($total, 2))}}</h4>
            </div>
        </div>
    </div>
</div>