 {{--var PerProduct = 0;--}}
 {{--var total = 0;--}}

 {{--$.each(data.demand_x_product, function(i, val){--}}
     {{--PerProduct += (parseFloat(val.price_registred) * val.quantity);--}}
     {{--total += parseFloat(PerProduct);--}}

     {{--$("#modal_demands").find("tbody").append('<tr>' +--}}
             {{--'<td>' + val.product.name + '</td>' +--}}
             {{--'<td> R$ ' + val.price_registred.replace('.', ',') + '</td>' +--}}
             {{--'<td>' + val.quantity + '</td>' +--}}
             {{--'<td> R$ ' + PerProduct.toFixed(2).replace('.', ',') + '</td>' +--}}
             {{--'</tr>');--}}
 {{--});--}}

{{--$("h4#value_total").html("<strong>Valor total:</strong> R$ " + total.toFixed(2).replace('.', ','));--}}


<div class="modal-content">
    <input type="hidden" id="productID" value="{{ $demand->id }}">
    <input type="hidden" id="status_demand_description" value="{{$demand->status_demand->description}}">
    <!-- Modal Header -->
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Visualização do pedido - #{{ $demand->id }}
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
                <h4><strong>Status: {{$demand->status_demand->description}}</strong> </h4>
            </div>
            <div class="col-md-6">
                <h4><strong>Retirada:</strong> {{$demand->hour_recall}}</h4>
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
            @foreach($demand->demand_x_product as $demand)
                <?php $PerProduct = round(($demand->price_registred * $demand->quantity), 2); ?>
                <tr>
                    <td>{{$demand->product->name}}</td>
                    <td>R$ <?= str_replace('.', ',', $demand->price_registred);?></td>
                    <td>{{$demand->quantity}}</td>
                    <td>R$ {{$demand->quantity}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <!-- Modal Footer -->
        <div class="modal-footer">
            <div class="col-md-6 buttons-options" style="text-align: left;">
                <button type="button" class="btn btn-success confirm_demand_product">Confirmar</button>
                <button type="button" class="btn btn-danger cancel_demand_product">Cancelar</button>
            </div>
            <div class="col-md-6 value-total">
                <h4 id="value_total"></h4>
            </div>
        </div>
    </div>
</div>