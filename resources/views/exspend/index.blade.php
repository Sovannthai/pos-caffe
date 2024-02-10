@extends('layouts.admin')

@section('title', 'Exspend')
@section('content-header', 'List Exspenses')
@section('content-actions')
    <a href="{{route('exspend.create')}}" class="btn btn-primary"><i class="fas fa-plus">Add New</i></a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class=" table-dark">
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Amount</th>
                        {{-- <th>Description</th> --}}
                        <th>Exspend Note</th>
                        <th>Create By</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exspends as $exspend )
                    <tr class="text-center">
                        <td>{{$exspend->name}}</td>
                        <td>{{ config('settings.currency_symbol') }} {{$exspend->amount}}</td>
                        {{-- <td>{{$exspend->description}}</td> --}}
                        <td>{{$exspend->exspend_note}}</td>
                        <td>{{$exspend->user->first_name}}</td>
                        <td>{{$exspend->created_at}}</td>
                        <td>
                            <div style="position: relative;">
                                    <span style="display: inline-flex">
                                        <a href="{{route('exspend.edit',$exspend->id)}}"
                                            class=" btn btn-primary btn-md text-uppercase"><i class="fas fa-edit"></i></a>
                                        <span class="dl">
                                            <form action="{{ route('exspend.destroy', $exspend->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-md text-uppercase" type="submit"> <i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </span>
                                    </span>
                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                    <th></th>
                    <th>Total:  {{ config('settings.currency_symbol') }}{{$total}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
