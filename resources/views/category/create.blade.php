@extends('layouts.admin')

@section('title', 'Category Management')
@section('content-header', 'Create Category')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class=" card-body">
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class=" form-group col-6">
                        <label for="">Category Name</label>
                        <input type="text" name="cate_name" class=" form-control">
                    </div>

                    <div class="form-group col-6">
                        <label for="Img">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="avatar">
                            <label class="custom-file-label" for="avatar">Choose File</label>
                        </div>
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class=" form-group container-fluid">
            <label for="">Description</label>
            <textarea name="description" rows="5" id="" class=" form-control"></textarea>
        </div>
        <button class="btn btn-success mb-3"style="position: relative;left:75.8vw; width:90px" type="submit">Submit</button>
        </form>
    </div>
    </div>

@endsection
