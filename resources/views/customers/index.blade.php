@extends('layouts.admin')

@section('title', 'Customer Management')
@section('content-header', 'Customer Management')
@section('content-actions')
<a href="{{route('customers.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add New Customer</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    {{-- <th>Avatar</th> --}}
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    {{-- <td>
                            <img width="150px" height="auto"  src="{{$customer->getAvatarUrl()}}" alt="">
                    </td> --}}
                    <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->created_at}}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form id="deleteForm{{ $customer->id }}" action="{{ route('customers.destroy',['customer'=>$customer->id]) }}" method="post" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-md text-uppercase btn-sm delete-button" type="button" data-transaction-id="{{ $customer->id }}"> <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $customers->render() }}
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.delete-button').on('click', function(e) {
            var transactionId = $(this).data('transaction-id');
            Swal.fire({
                title: "Are you sure?"
                , text: "You won't be able to revert this!"
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm' + transactionId).submit();
                }
            });
        });
    });

</script>
@endsection
