@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            {{-- alert start --}}
                            @if (Session::has('fail'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ Session::get('fail') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('lengthError'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('lengthError') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}

                            <form class="form-horizontal" method="post" action="{{ route('admin#changePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-4 col-form-label">Old Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="oldPassword"
                                            class="form-control" id="oldPassword">
                                    </div>
                                    @error('oldPassword')
                                        <div class="text-danger offset-4">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="newPassword"
                                            class="form-control" id="newPassword">
                                    </div>
                                    @error('newPassword')
                                        <div class="text-danger offset-4">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="confirmNewPassword" class="col-sm-4 col-form-label">Confirm New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="confirmNewPassword"
                                            class="form-control" id="confirmNewPassword">
                                    </div>
                                    @error('confirmNewPassword')
                                        <div class="text-danger offset-4">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="offset-4 col-sm-8">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
