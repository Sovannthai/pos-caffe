<style>
    span {
        font-size: 20px;
    }

    .card-total {
        right: 20px;
        width: 750px;
    }
    .card-body {
  position: relative;
  overflow: hidden;
}

.table-container {
  overflow: auto;
  height: 300px; /* Adjust the height as per your requirement */
}

.table-container thead th {
  position: sticky;
  top: 0;
  background-color: #fff;
  z-index: 1;
}
</style>
<div class="card col-6" style="height: 500px">
    <div class="card-body">
        <div class="table-container">
            <table class="table border-0" id="table-cart">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit</th>
                        <th></th>
                        <th>Qty</th>
                        <th></th>
                        <th>Price</th>
                        <th>
                            <li class="fas fa-times"></li>
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="card-full-footer text-white" style="background-color: cornflowerblue;width: 770px;">
        <div class="block-total" style="position: relative;left: 6cm;">
            <span>Total Qty: <span class="total_qty"></span></span><br>
            <span>Subtotal: {{ config('settings.currency_symbol') }} <span class="sub_total" id="sub_total"></span></span><br>
            <span id="">Discount:</span><br>
            <span>Total : {{ config('settings.currency_symbol') }} <span class="sub_total"></span></span>
        </div>
    </div>
</div>
