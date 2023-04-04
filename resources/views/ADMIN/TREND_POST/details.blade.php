@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-6 offset-3 mt-5 text-center">
        <div class="card-header">
            <img style="width: 200px; height: 270px" @if ($data['post_image'] == '')
                src="{{ asset('defaultImage/defaultImage.png') }}" alt=""
            @else
                src="{{ asset('postImage/'. $data['post_image']) }}" alt=""
            @endif>
        </div>
        <div class="card_body">
            <h4>{{ $data['post_title'] }}</h4>
            <p>{{ $data['post_description'] }}</p>
            <a href="{{ route('admin#trendPost') }}">
                <button class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i></button>
            </a>
        </div>
        <!-- /.card -->
    </div>
@endsection
