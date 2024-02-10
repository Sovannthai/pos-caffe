@extends('layouts.admin')

@section('title', 'All Sale')
@section('content-header', 'All Sale ')
@section('content-actions')
{{-- --}}
@endsection

@section('content')
<style>
    .form-control {
        btransaction-radius: 0;
    }

</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
                <form action="{{ route('transaction.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="start-date">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" />
                        </div>
                        <div class="col-md-5">
                            <label for="end-date">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" />
                        </div>
                        <div class="col-md-2" style="margin-top: 30px">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Status</label>
                        <select id="status-filter" name="status" class="form-control">
                            <option value="" {{ request('status')==''?'selected':'' }}>All</option>
                            <option value="due" {{ request('status')=='due'?'selected':'' }}>Due</option>
                            <option value="partial" {{ request('status')=='partial'?'selected':'' }}>Partial</option>
                            <option value="paid" {{ request('status')=='paid'?'selected':'' }}>Paid</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="">Customer</label>
                        <select name="customer_id" id="customer-select" class="form-control">
                            <option value="">Select customer...</option>
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer')== $customer->id ? 'selected' : '' }}>
                                {{ $customer->first_name }} {{ $customer->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <table class="table table-btransactioned table-hover table-bordered">
            <thead class="thead-dark text-uppercase">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Table</th>
                    <th>Total Paid</th>
                    <th>Status</th>
                    <th>Discount</th>
                    <th>Subtotal</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }} </td>
                    <td>{{ $transaction->customer->first_name }} {{ $transaction->customer->last_name }}</td>
                    <td>{{ $transaction->table->table_name }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->total_paid }}</td>
                    <td>
                        @if($transaction->status == 'due')
                        <span class=" btn btn-sm btn-warning">Due</span>
                        @elseif($transaction->status == 'partial')
                        <span class=" btn btn-sm btn-info text-white">Partial</span>
                        @else
                        <span class=" btn btn-sm btn-success">Paid</span>
                        @endif
                    </td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->discount ?? 0 }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->subtotal }}</td>
                    <td>{{ config('settings.currency_symbol') }} {{ $transaction->total }}</td>
                    <td>
                        <div style="display:flex;">
                            <span>
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i></a>
                            </span>
                            <span>
                                <a href="" class="btn btn-secondary btn-sm ml-2"><i class="fas fa-eye"></i></a>
                            </span>
                            <span>
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-md text-uppercase btn-sm ml-2" type="submit"> <i class="fas fa-trash"></i></button>
                                </form>
                            </span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total Paid:  {{ config('settings.currency_symbol') }} {{$totalpaid}}</th>
                    <th></th>
                    <th>Total Discount:  {{ config('settings.currency_symbol') }} {{$discount}}</th>
                    <th>Subtotal:  {{ config('settings.currency_symbol') }} {{$subtotal}}</th>
                    <th>Total Paid:  {{ config('settings.currency_symbol') }} {{$total_amount}}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
     document.getElementById('customer-select').addEventListener('change', function() {
        var customer = this.value;
        if (customer === '') {
            window.location.href = "{{ route('transaction.index') }}";
        } else {
            window.location.href = "{{ route('transaction.index') }}?customer=" + customer;
        }
    });
</script>
<script>
    document.getElementById('status-filter').addEventListener('change', function() {
        var status = this.value;
        if (status === '') {
            window.location.href = "{{ route('transaction.index') }}";
        } else {
            window.location.href = "{{ route('transaction.index') }}?status=" + status;
        }
    });

</script>
@endsection
