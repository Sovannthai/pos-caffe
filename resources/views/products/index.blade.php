@extends('layouts.admin')

@section('title', 'Product Management')
@section('content-header', 'Product Management')
@section('content-actions')
<a href="{{ route('products.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add New Product</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    {{-- <th>Barcode</th> --}}
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Price</th>
                    {{-- <th>Quantity</th> --}}
                    <th>Status</th>
                    {{-- <th>Created At</th>
                        <th>Updated At</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img class="product-img img-thumbnail" src="{{ Storage::url($product->image) }}" alt=""></td>
                    {{-- <td>{{ $product->barcode }}</td> --}}
                    <td>{{ $product->category->cate_name }}</td>
                    <td>{{ $product->unit->unit_name}}</td>
                    <td>{{ config('settings.currency_symbol') }}{{ $product->price }}</td>
                    {{-- <td>{{ $product->quantity }}</td> --}}
                    <td>
                        <span class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span>
                    </td>
                    {{-- <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td> --}}
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy',['product'=>$product->id]) }}" method="post" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-md text-uppercase btn-sm delete-button" type="button" data-transaction-id="{{ $product->id }}"> <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->render() }}
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
