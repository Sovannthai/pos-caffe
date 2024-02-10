@extends('layouts.admin')

@section('title', 'Add Exspend')
@section('content-header', 'Add Exspend')
@section('content-actions')

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<style>
    .form-control{
        border-radius: 0;
    }
</style>
        <div class="card">
            <div class="card-body">
                <form action="{{route('exspend.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Exspend For</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        {{-- <div class="form-group col-6">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div> --}}
                        <div class="form-group col-12">
                            <label for="">Exspend Note</label>
                            <textarea name="exspend_note" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" style="position: relative;left:74.2vw; width:90px">Save</button>
                </form>
            </div>
        </div>
@endsection
