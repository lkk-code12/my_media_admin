@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List Edit Page</h3>
            </div>
            <!-- /.card-header -->
            <div class="col-4 offset-4">
                <form action="{{ route('admin#updateCategory', $data->category_id) }}" method="post">
                    @csrf
                    <div class="mt-3 ml-3 mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" name="categoryName" value="{{ old('categoryName', $data->category_title) }}" class="form-control" id="categoryName"
                            placeholder="Enter name">
                        @error('categoryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3 ml-3 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="categoryDescription" id="" cols="38" rows="7" placeholder="Enter descrption">{{ old('categoryDescription', $data->category_description) }}</textarea>
                        @error('categoryDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center pb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin#category') }}">
                            <input type="button" value="Create" class="btn btn-dark ml-3">
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
