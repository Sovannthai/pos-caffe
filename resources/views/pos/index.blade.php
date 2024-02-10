<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS</title>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<style>
    .form-control {
        border-radius: 0;
    }

    .pose {
        border-radius: 0;
        transition: 0.5s;
    }

    .pose:hover {
        transform: scale(1.1);
    }

    .poss {
        border-radius: 0;
        transition: 0.5s;
    }

    .poss:hover {
        transform: scale(1.1);
    }

    .cd-h {
        transition: 0.5s;
    }

    .cd-h:hover {
        transform: scale(1.1);
    }

    .product-img {
        width: 2cm;
        height: 80px;
    }

    .pos-product {
        font-size: 20px;
    }

    .text-all {
        font-size: 20px;
    }

    .cancel {
        width: 130px;
        height: 50px;
        border-radius: 0 5px 0 5px;
    }

    .finish {
        width: 160px;
        border-radius: 0 5px 0 5px;
    }

</style>

<body>
    <div class="card" style="background-color: #ff7423fc;;">
        <div class="card-body" style="height: 80px;">
            <div class="row">
                <div class=" form-group col-3">
                    <select name="customer_id" class="form-control">
                        <option value="">General Customer...</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" id="selected_customer_id">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" form-group col-3">
                    <select name="customer_id" class="form-control">
                        <option value="">Select Table...</option>
                        @foreach ($tables as $table)
                        <option value="{{ $table->id }}" id="selected_table_id">{{ $table->table_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" form-group col-3" style="position: relative;
                left: 320px;">
                    <form class="d-flex" role="search" action="{{ url()->current() }}" method="GET">
                        <input class="form-control" type="text" name="search" placeholder="Search..." aria-label="Search" style="position: relative;left:-10px;">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
                <div class=" form-group col-3" style="position: relative;
                left: 300px;">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="height: 500px">
        <form action="{{ route('checkout') }}" method="POST" id="frmCh">
            <div class="card-full-body">
                <div class="row">
                    @include('pos.partials.addproduct')
                    <div class="card col-6" style="height: 500px; overflow-y: scroll;">
                        <div class="card-full-body">
                            <div class="row mt-4 pd">
                                @foreach ($products as $product)
                                <div class="col-6 product" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-unit="{{ $product->unit->shot_name }}" data-price="{{ $product->price }}">
                                    <div class="card cd-h">
                                        <div>
                                            <img class="product-img" src="{{ Storage::url($product->image) }}" alt="">
                                            {{ $product->name }} ({{ config('settings.currency_symbol') }}
                                            {{ $product->price }})
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end mx-2 " style="position: relative; right: 0px;">
                <button class="btn btn-danger mb-2 mx-3 pose cancel text-all" type="button">CANCEL All</button>
                <button class="btn btn-success mb-2 pose finish text-all checkout" data-bs-toggle="modal" type="button" data-bs-target="#checkout">CHECKOUT</button>
                @include('pos.create')
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var subtotal = 0;
        var total_qty = 0;
        var amount = 0;
        $(document).on('click', '.checkout', function() {
            // Get the subtotal, total quantity, and amount data
            var customer = $('#selected_customer_id').val();
            var table = $('#selected_table_id').val();
            var subtotal = $('#sub_total').text();
            var totalQty = $('.total_qty').text();
            var total = $('#sub_total').text();

            // Set the values in the checkout form fields
            $('#frmCh input[name="subtotal"]').val(subtotal);
            $('#frmCh input[name="total_qty"]').val(totalQty);
            $('#frmCh input[name="customer_id"]').val(customer);
            $('#frmCh input[name="table_id"]').val(table);
            $('#frmCh input[name="total"]').val(total);
            $('#frmch input[name="total_paid"]').attr('max', parseFloat(total));
            // Show the checkout modal
            $('#checkout').modal('show');

        });
        $(document).on('input', '#input-total', function() {
            var totalInput = parseFloat($(this).val());
            var total = parseFloat($('#sub_total').text());

            if (totalInput > total) {
                $('#max-value').removeClass('d-none').text('Total paid amount cannot exceed the total!');
                $(this).val(total);
            } else {
                $('#max-value').addClass('d-none').text('');
            }

        });

        $(document).on('click', '.product', function() {
            var product_id = $(this).data('id');
            var product_name = $(this).data('name');
            var product_unit = $(this).data('unit');
            var product_price = $(this).data('price');
            var qty = 1;
            var add_ajax = true;
            var row_total = product_unit * product_unit;
            $('#table-cart tbody').find("tr").each(function() {
                var row_product_id = $(this).find('.row_product_id').val();
                if (row_product_id == product_id) {
                    add_ajax = false;
                    var qty_element = $(this).find('.row_qty');
                    var qty_x = parseInt(qty_element.val()) + 1;
                    var row_qty = qty_x;
                    qty_element.val(row_qty).change();

                    $(this).find('.row_amount').val(product_price * row_qty)
                        .change();
                    $(this).find('.label_row_amount').text(product_price * row_qty);
                }
            });
            total_qty += parseFloat(qty);
            $('.total_qty').text(total_qty);
            subtotal += parseFloat(product_price);
            $('.sub_total').text(subtotal);
            amount += parseFloat(product_price);
            $('.amount').val(subtotal);

            if (add_ajax) {
                var html = `
                        <tr class="tr_${product_id} pos-product">
                            <td>${product_name} <input type="hidden" name="products[${product_id}][product_id]" value="${product_id}"></td>
                            <td>(${product_unit})</td>
                            <td>
                                <button type="button" class="decrease-qty btn btn-danger"><i class="fas fa-minus-circle"></i></button>
                            </td>
                            <td>
                                <input type="number" class="row_qty form-control" name="products[${product_id}][qty]" style="width: 65px" value="${qty}">
                            </td>
                            <td>
                                <button type="button" class="increase-qty btn btn-primary row_incrase"><i class="fas fa-plus"></i></button>
                            </td>
                            <td>
                                <span>{{ config('settings.currency_symbol') }}<span class="label_row_amount">${product_price}</span></span>
                            </td>
                            <td>
                                <input type="hidden" class="unit_price" name="products[${product_id}][unit_price]" value="${product_price}"/>
                                <input type="hidden" class="row_amount" name="products[${product_id}][subtotal]" value="${product_price}"/>
                                <button class="delete-product btn btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>`;
                $(`#table-cart tbody`).append(html);
            }
        });
        $(document).on('click', '.cancel', function() {
            $('#table-cart').find('tbody tr').remove();
        })

        $(document).on('click', '.cancel', function() {
            $('.block-total').find('.sub_total').text(0);
            $('.block-total').find('.total_qty').text(0);
            $('div.modal-body').find('.amount').val(0);
            subtotal = 0;
            total_qty = 0;
            amount = 0;
        })

        $(document).on('click', '.delete-product', function() {
            var row_amount = $(this).closest('tr').find('.label_row_amount').text();
            var row_qty = $(this).closest('tr').find('.row_qty').val();
            var amount = $(this).closest('div').find('.modal-body').val();
            subtotal -= parseFloat(row_amount);
            total_qty -= parseFloat(row_qty);
            amount -= parseFloat(amount);
            $('.block-total').find('.sub_total').text(subtotal);
            $('.block-total').find('.total_qty').text(total_qty);
            // $('.modal-body').find('.amount').val(0);
            // $(this).closest('div.modal-body').remove();
            $(this).closest('tr').remove();
        });

        $(document).on('click', '.increase-qty', function() {
            var total_price = 0;
            var product_price = $(this).closest('tr').find('.unit_price').val();
            var qty_element = $(this).closest('tr').find('.row_qty');
            var row_qty = parseInt(qty_element.val()) + 1;
            qty_element.val(row_qty).change();
            $(this).closest('tr').find('.row_amount').val(product_price * row_qty).change();
            $(this).closest('tr').find('.label_row_amount').text(product_price * row_qty);
            subtotal += parseFloat(product_price);
            total_qty += 1;
            $('.sub_total').text(subtotal);
            $('.total_qty').text(total_qty);

        });

        $(document).on('click', '.decrease-qty', function() {
            var total_price = 0;
            var product_price = $(this).closest('tr').find('.unit_price').val();
            var qty_element = $(this).closest('tr').find('.row_qty');
            var row_qty = parseInt(qty_element.val()) - 1;
            if (row_qty >= 1) {
                qty_element.val(row_qty).change();
                $(this).closest('tr').find('.row_amount').val(product_price * row_qty)
                    .change();
                $(this).closest('tr').find('.label_row_amount').text(product_price *
                    row_qty);
                subtotal -= parseFloat(product_price);
                total_qty -= 1;
                $('.sub_total').text(subtotal);
                $('.total_qty').text(total_qty);
            }
        });
    });

</script>
<script>
    const Toast = Swal.mixin({
        toast: true
        , position: 'top-right',
        // iconColor: 'white',
        customClass: {
            popup: "colored-toast {{ (config('app.dark_mode') == 1 ? 'dark-colored-toast' : '') }}"
        }
        , showConfirmButton: false
        , timer: 3000
        , timerProgressBar: true
        , didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    , });

    @if(Session::get('success'))
    Toast.fire({
        icon: 'success'
        , title: `{{ Session::get('success') }}`,
        // message: ,
    });
    @endif
    @if(Session::get('error'))
    Toast.fire({
        icon: 'error'
        , title: `{{ Session::get('error') }}`,
        // message: ,
    });
    @endif

</script>
</html>
