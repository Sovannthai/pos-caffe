@extends('layouts.admin')

@section('title', 'Unit')
@section('content-header', 'Table')
@section('content-actions')
    <a href="" class="btn btn-success" data-toggle="modal" data-target="#create"><i class="fas fa-plus"></i>Add Table</a>
    @include('table.create')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Table Name</th>
                        <th>Shot Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tables as $table)
                    <tr>
                        <td>{{ $table->table_name }}</td>
                        <td>{{ $table->shot_name }}</td>
                        <td>
                            <a href=""  data-toggle="modal" data-target="#edit-{{ $table->id }}"><li class="fas fa-edit" style="font-size: 20px"></li></a>
                            @include('table.edit')
                            <a href="{{ route('table.destroy',['id'=>$table->id]) }}"><li class="fas fa-trash"style="font-size: 20px; color:red;" ></li></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            <h5>No data</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
