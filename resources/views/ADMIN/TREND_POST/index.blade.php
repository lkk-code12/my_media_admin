@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Post Page</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Post Image</th>
                            <th>View Count</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actionLog as $action)
                            <tr>
                                <td>{{ $action['post_id'] }}</td>
                                <td>{{ $action['post_title'] }}</td>
                                <td>
                                    <img style="width: 50px; height: 70px;" alt=""
                                        @if ($action->post_image == null) src="{{ asset('defaultImage/defaultImage.png') }}"
                                                @else src="{{ asset('postImage/' . $action->post_image) }}" @endif>
                                </td>
                                <td><i class="fa-solid fa-eye mr-2"></i><span>{{ $action['post_count'] }}</span></td>
                                <td>
                                    <a href="{{ route('admin#trendPostDetails', $action['post_id']) }}">
                                        <button class="btn btn-sm bg-danger">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-5">
                    {{-- {{ $actionLog->links() }} --}}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
