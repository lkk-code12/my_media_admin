@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Post Page</h3>
            </div>
            <!-- /.card-header -->
            <div class="row">
                <div class="col-4 offset-4">
                    <form action="{{ route('admin#updatePost', $postData['post_id']) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3 ml-3 mb-3">
                            <label for="postTitle" class="form-label">Title</label>
                            <input type="text" name="postTitle" value="{{ $postData['post_title'] }}"
                                class="form-control" id="postTitle" placeholder="Enter name">
                            @error('postTitle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="" cols="38" rows="7" placeholder="Enter descrption">{{ $postData['post_description'] }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="postImage">Image</label>
                            <div class="row d-flex justify-content-center shadow-lg py-3 my-3">
                                <img @if ($postData['post_image'] == null)
                                    src="{{ asset('defaultImage/defaultImage.png') }}"
                                @else
                                    src="{{ asset('postImage/' . $postData['post_image']) }}"
                                @endif
                                    style="width: 150px; height: 100px;" alt="">
                            </div>
                            <input type="file" name="postImage" value="{{ $postData['post_image'] }}" class="form-group"
                                id="postImage">
                        </div>
                        <div class="mt-3 ml-3 mb-3">
                            <label for="postCategory" class="form-label">postCategory</label>
                            <select name="postCategory" class="form-control" id="">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}"
                                        @if ($category['category_id'] == $postData['category_id']) selected @endif>{{ $category->category_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-center pb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
