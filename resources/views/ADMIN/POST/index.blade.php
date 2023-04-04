@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post Page</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#searchCategory') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="searchCategory" value="{{ old('searchCategory') }}"
                                class="form-control float-right" placeholder="Search">

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
                    <form action="{{ route('admin#createPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3 ml-3 mb-3">
                            <label for="postTitle" class="form-label">Title</label>
                            <input type="text" name="postTitle" value="{{ old('postTitle') }}" class="form-control"
                                id="postTitle" placeholder="Enter name">
                            @error('postTitle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="" cols="38" rows="7" placeholder="Enter descrption">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="postImage">Image</label>
                            <input type="file" name="postImage" class="form-group" id="postImage">
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="postCategory" class="form-label">postCategory</label>
                            <select name="postCategory" class="form-control" id="">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_title }}</option>
                                @endforeach
                            </select>
                            @error('postCategory')
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
                                    <th>Image</th>
                                    <th>Other</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $item)
                                    <tr>
                                        <td>{{ $item->post_id }}</td>
                                        <td>{{ $item->post_title }}</td>
                                        <td>
                                            <img style="width: 50px; height: 70px;" alt=""
                                                @if ($item->post_image == null) src="{{ asset('defaultImage/defaultImage.png') }}"
                                                @else src="{{ asset('postImage/' . $item->post_image) }}"
                                                @endif>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin#updatePostPage', $item->post_id) }}">
                                                <button class="btn btn-sm bg-dark text-white"><i
                                                        class="fas fa-edit"></i></button>
                                            </a>
                                            <a href="{{ route('admin#deletePost', $item->post_id) }}">
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
