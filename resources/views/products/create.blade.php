@extends('layouts.admin')

@section('title', 'Create Product')
@section('content-header', 'Create Product')

@section('content')
<style>
    .form-control {
        border-radius: 0;
    }

    .custom-file-label {
        border-radius: 0;
    }

</style>

<div class="card full">
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter product name" value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- <div class="form-group col-4">
                        <label for="barcode">Barcode</label>
                        <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror"
                            id="barcode" placeholder="Enter barcode number" value="{{ old('barcode') }}">
                @error('barcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}

            <div class="form-group col-4">
                <label for="image">Product Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image">
                    <label class="custom-file-label" for="image">Choose File</label>
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-4">
                <label for="">Category</label>
                <select name="category_id" id="category" class="form-control">
                    @foreach ($categorys as $category)
                    <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                    @endforeach
                </select>
                @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label for="">Unit</label>
            <select name="unit_id" id="unit" class="form-control">
                @foreach ($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                @endforeach
            </select>
            @error('unit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-4">
            <label for="price">Price</label>
            <input type="number" step="any" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter price" value="{{ old('price') }}">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        {{-- <div class="form-group col-4">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                            id="quantity" placeholder="Quantity" value="{{ old('quantity', 1) }}">
        @error('quantity')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> --}}

    <div class="form-group col-4">
        <label for="status">Status</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
            <option value="1" {{ old('status') === 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter short description">{{ old('description') }}</textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    <button class="btn btn-success" type="submit">Save</button>
</div>
</form>
</div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

</script>
@endsection
