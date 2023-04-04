@extends('ADMIN.LAYOUTS.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            {{-- alert start --}}
                            @if (Session::has('updateProfileSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('updateProfileSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}

                            <form class="form-horizontal" method="post" action="{{ route('admin#update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="inputName" value="{{ old('inputName', $user_info->name) }}"
                                            class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                    @error('inputName')
                                        <div class="text-danger offset-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="inputEmail" value="{{ old('inputEmail', $user_info->email) }}"
                                            class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                    @error('inputEmail')
                                        <div class="text-danger offset-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="inputPhone" value="{{ $user_info->phone }}"
                                            class="form-control" id="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputAddress" id="address" class="form-control" cols="30" rows="5" placeholder="address">{{ $user_info->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="">Gender</label>
                                    <div class="col-sm-5 text-center">
                                        @if ($user_info->gender == 'male')
                                            <input type="radio" name="inputGender" value="male" id="male" checked>
                                            <label for="male">Male</label>
                                            <input type="radio" name="inputGender" value="female" id="female">
                                            <label for="female">female</label>
                                        @else
                                            <input type="radio" name="inputGender" value="male" id="male">
                                            <label for="male">Male</label>
                                            <input type="radio" name="inputGender" value="female" id="female" checked>
                                            <label for="female">female</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-2 col-sm-10">
                                    <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
