@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List Page</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#searchCategory') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="searchCategory" value="{{ old('searchCategory') }}" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="row">
                <div class="col-4">
                    <form action="{{ route('admin#createCategory') }}" method="post">
                        @csrf
                        <div class="mt-3 ml-3 mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" name="categoryName" class="form-control" id="categoryName"
                                placeholder="Enter name">
                            @error('categoryName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="categoryDescription" id="" cols="38" rows="7" placeholder="Enter descrption"></textarea>
                            @error('categoryDescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center pb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
                <div class="col-7 offset-1">
                    <div class="card-body table-responsive p-0">
                        {{-- alert start --}}
                        @if (Session::has('deleted'))
                            <div class="alert alert-success alert-dismissible fade show w-50 offset-3 my-3" role="alert">
                                {{ Session::get('deleted') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="text-white">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{-- alert end --}}
                        <table class="table table-hover text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Other</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    <tr>
                                        <td>{{ $item->category_id }}</td>
                                        <td>{{ $item->category_title }}</td>
                                        <td>{{ $item->category_description }}</td>
                                        <td>
                                            <a href="{{ route('admin#editCategoryPage', $item->category_id) }}">
                                                <button class="btn btn-sm bg-dark text-white"><i
                                                    class="fas fa-edit"></i></button>
                                            </a>
                                            <a href="{{ route('admin#deleteCategory', $item->category_id) }}">
                                                <button class="btn btn-sm bg-danger text-white"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
