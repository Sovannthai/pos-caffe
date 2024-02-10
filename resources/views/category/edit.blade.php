@extends('layouts.admin')

@section('title', 'Category Management')
@section('content-header', 'Edit Category')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class=" card-body">
            <form action="{{route('category.update',$category)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class=" form-group col-6">
                        <label for="">Category Name</label>
                       <input type="text" name="cate_name" class="form-control" value="{{$category->cate_name}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="Img">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo">
                            <label class="custom-file-label" for="avatar">Choose File</label>
                        </div>
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class=" form-group container-fluid">
            <label for="">Description</label>
            <textarea name="description"class=" form-control">{{$category->description}}</textarea>
        </div>
        <button class="btn btn-success mb-3"style="position: relative;left:74.8vw; width:90px" type="submit">Update</button>
        </form>
    </div>
    </div>

@endsection
