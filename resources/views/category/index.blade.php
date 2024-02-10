@extends('layouts.admin')

@section('title', 'Category Management')
@section('content-header', 'Category Management')
@section('content-actions')
    <a href="{{ route('category.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>Add Category</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')

    <table class="table table-bordered">
        <thead class="table-dark table-hover">
            <tr class="text-center">
                <th>Category Name</th>
                <th>Description</th>
                {{-- <th>Image</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $categorys)
                <tr class="text-center">
                    <td>{{ $categorys->cate_name }}</td>
                    <td>{{ $categorys->description }}</td>
                    {{-- <td><img class="" src="{{ Storage::url($categorys->photo) }}" alt=""
                            style="width: 80px; height:70px;"></td> --}}
                    <td>
                        <div class=" justify-content-center" style="display: flex;">
                            <span>
                                <a href="{{ route('category.edit', $categorys->id) }}"
                                    class="btn btn-primary btn-md  text-uppercase"> <i class="fas fa-edit"></i></a>
                            </span>
                            <span>
                                <form action="{{ route('category.destroy', $categorys->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-md text-uppercase" type="submit"> <i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </span>
                        </div>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-delete', function() {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this category?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        }, function(res) {
                            $this.closest('tr').fadeOut(500, function() {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection
