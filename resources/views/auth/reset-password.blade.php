@extends('layouts.app')

@section('contents')
    <div class="row m-0 p-0 justify-content-center align-items-center h-100 my-3">
        <div class="col-sm-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="login-header d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title text-center text-white">Reset Password</h5>
                        <p class="card-text text-center text-white">Rreset your password.</p>
                    </div>
                    <form class="mt-3" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        @if(session()->has('success'))
                            <div class="alert alert-success text-center mt-2">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger text-center mt-2">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if(session()->has('status'))
                            <div class="alert alert-success text-center mt-2">
                                {{ session()->get('status') }}
                            </div>
                        @endif
            
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control {{($errors->first('email') ? "border border-danger" : "")}}" 
                            id="email" name="email" placeholder="Enter email" value="{{ Request()->email }}" readonly>
                            @error('email')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control {{($errors->first('password') ? "border border-danger" : "")}}" 
                                id="password" name="password" placeholder="Password">
                            @error('password')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                          </div>
                          <div class="form-group">
                              <label for="password_confirmation">Confirm Password</label>
                              <input type="password" class="form-control {{($errors->first('password_confirmation') ? "border border-danger" : "")}}" 
                                id="password_confirmation" name="password_confirmation" placeholder="Password">
                            @error('password_confirmation')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                          </div>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <span>Back to login?<a href="{{ route('login') }}">login</a></span>
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection
