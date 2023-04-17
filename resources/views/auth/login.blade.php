@extends('layouts.app')

@section('contents')
<div class="row m-0 p-0 justify-content-center align-items-center h-100 my-3">
  <div class="col-sm-12 col-md-5">
      <div class="card">
          <div class="card-body">
              <div class="login-header d-flex flex-column justify-content-center align-items-center">
                  <h5 class="card-title text-center text-white">Login Here</h5>
                  <p class="card-text text-center text-white">You can login here usign below info.</p>
              </div>

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

              <form class="mt-3" method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control {{($errors->first('email') ? "border border-danger" : "")}}" 
                      id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                      @error('email')
                        <small class="text-danger mb-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control {{($errors->first('password') ? "border border-danger" : "")}}" 
                      id="password" name="password" placeholder="Your Password">
                    @error('password')
                      <small class="text-danger mb-2" role="alert">
                          <strong>{{ $message }}</strong>
                      </small>
                    @enderror
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember my preference</label>
                  </div>
                  <div class="text-center mt-2">
                      <button type="submit" class="btn btn-primary w-100">Login</button>
                  </div>
              </form>
              <div class="d-flex justify-content-between">
                  <span><a href="{{ route('register') }}">Create new account?</a></span>
                  <span><a href="{{ route('password.request') }}">Forget password?</a></span>
              </div>
          </div>
        </div>
  </div>
</div>
@endsection