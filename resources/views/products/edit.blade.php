@extends('layouts.admin')

@section('title', 'Edit Product')
@section('content-header', 'Edit Product')

@section('content')
<style>
    .form-control{
        border-radius: 0;
    }
    .custom-file-label{
        border-radius: 0;
    }
</style>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group col-3">
                        <label for="barcode">Barcode</label>
                        <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror"
                            id="barcode" placeholder="barcode" value="{{ old('barcode', $product->barcode) }}">
                        @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}

                    <div class="form-group col-3">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Category</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif >{{ $category->cate_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label for="">Unit</label>
                        <select name="unit_id" class="form-control">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @if ($product->unit_id == $unit->id)selected @endif>{{$unit->unit_name}}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="form-group col-3">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                        id="price" placeholder="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- <div class="form-group col-3">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                        id="quantity" placeholder="Quantity" value="{{ old('quantity', $product->quantity) }}">
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}

                <div class="form-group col-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                        <option value="1" {{ old('status', $product->status) === 1 ? 'selected' : '' }}>Active
                        </option>
                        <option value="0" {{ old('status', $product->status) === 0 ? 'selected' : '' }}>Inactive
                        </option>
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
                    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" id="description"
                        placeholder="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-success" type="submit" style="position: relative;left:74.2vw; width:90px;">Update</button>
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
