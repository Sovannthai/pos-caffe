@extends('layouts.admin')

@section('title', 'All Sale')
@section('content-header', 'All Sale ')
@section('content-actions')
    {{--  --}}
@endsection

@section('content')
    <style>
        .form-control {
            border-radius: 0;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-md-3"></div> -->
                <div class="col-md-12">
                    <form action="{{ route('orders.index') }}">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="start-date">Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}" />
                            </div>
                            <div class="col-md-5">
                                <label for="end-date">End Date</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}" />
                            </div>
                            <div class="col-md-2" style="margin-top: 30px">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Received</th>
                        <th>Status</th>
                        {{-- <th>Total Due</th> --}}
                        {{-- <th>create By</th> --}}
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->getCustomerName() }}</td>
                            <td>{{ config('settings.currency_symbol') }} {{ $order->formattedTotal() }}</td>
                            <td>{{ config('settings.currency_symbol') }} {{ $order->formattedReceivedAmount() }}</td>
                            <td>
                                @if ($order->receivedAmount() == 0)
                                    <span class="badge badge-danger">Not Paid</span>
                                @elseif($order->receivedAmount() < $order->total())
                                    <span class="badge badge-warning">Partial</span>
                                @elseif($order->receivedAmount() == $order->total())
                                    <span class="badge badge-success">Paid</span>
                                @elseif($order->receivedAmount() > $order->total())
                                    <span class="badge badge-info">Change</span>
                                @endif
                            </td>
                            {{-- <td>{{ config('settings.currency_symbol') }}
                                {{ number_format($order->total() - $order->receivedAmount(), 2) }}</td> --}}
                            {{-- <td>{{ $order->user_id }}</td> --}}
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <div style="display:flex;">
                                    <span>
                                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop-{{ $order->id }}"><i class="fas fa-eye"></i></a>
                                    </span>
                                    {{-- modal --}}
                                    @include('orders.show')
                                    <span>
                                        <form action="{{ route('orders.destroy', $order) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-md text-uppercase" type="submit"> <i
                                                    class="fas fa-trash"></i></button>
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
                        <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                        <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            {{ $orders->render() }}
        </div>
    </div>
@endsection
