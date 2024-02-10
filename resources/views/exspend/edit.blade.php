@extends('layouts.admin')

@section('title', 'Edit')
@section('content-header', 'Edit Exspend')
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
                <form action="{{route('exspend.update',$exspend)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Exspend For</label>
                            <input type="text" name="name" class="form-control" value="{{$exspend->name}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Amount</label>
                            <input type="number" name="amount" class="form-control" value="{{$exspend->amount}}">
                        </div>
                    </div>

                    <div class="row">
                        {{-- <div class="form-group col-6">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control">{{$exspend->description}}</textarea>
                        </div> --}}
                        <div class="form-group col-12">
                            <label for="">Exspend Note</label>
                            <textarea name="exspend_note" class="form-control">{{$exspend->exspend_note}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" style="position: relative;left:74.2vw; width:90px">Updates</button>
                </form>
            </div>
        </div>
@endsection
