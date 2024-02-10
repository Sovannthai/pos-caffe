@extends('layouts.admin')

@section('title', 'Unit')
@section('content-header', 'Unit')
@section('content-actions')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
<style>
    .form-control{
        border-radius: 0;
    }
</style>
@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('unit.store')}}" method="POST">
                @csrf
                @method('post')
                <div class="row">
                <div class="form-group col-6">
                        <label for="">Name</label>
                        <input type="text" name="unit_name" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="">Shot Name</label>
                    <input type="text" name="shot_name" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
