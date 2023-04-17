@extends('layouts.app')

@section('contents')
    <div class="row m-0 p-0 justify-content-center align-items-center h-100 my-3">
        <div class="col-sm-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="login-header d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title text-center text-white">Profile</h5>
                        <p class="card-text text-center text-white">You can update you info here.</p>
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

                    <form class="mt-3" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('assets/images/user.png') }}" alt="" 
                                  class="profile-image"
                                  id="avatar">
                                <div class="mb-3">
                                    <input class="form-control {{($errors->first('avatar') ? "border border-danger" : "")}}" 
                                      type="file" id="avatarInp" name="avatar">
                                </div>
                                @error('avatar')
                                  <small class="text-danger mb-2" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </small>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control {{($errors->first('name') ? "border border-danger" : "")}}" 
                                      id="name" 
                                      value="{{ Auth::user()->name ? Auth::user()->name : '' }}" 
                                      placeholder="Enter your name">
                                    @error('name')
                                      <small class="text-danger mb-2" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="email">Email address</label>
                                  <input type="email" class="form-control {{($errors->first('email') ? "border border-danger" : "")}}" 
                                    id="email" name="email"
                                    value="{{ Auth::user()->email ? Auth::user()->email : '' }}"
                                    placeholder="Enter email">
                                    @error('email')
                                      <small class="text-danger mb-2" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
                    
                    <form class="mt-3" action="{{ route('user.password.update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Current Password</label>
                            <input type="password" class="form-control {{($errors->first('old_password') ? "border border-danger" : "")}}" 
                              id="old_password" name="old_password" placeholder="Old Password">
                              @error('old_password')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                              @enderror
                          </div>
                        <div class="form-group">
                          <label for="new_password">New Password</label>
                          <input type="password" class="form-control {{($errors->first('password') ? "border border-danger" : "")}}" 
                            id="new_password" name="password" placeholder="New Password">
                            @error('password')
                              <small class="text-danger mb-2" role="alert">
                                  <strong>{{ $message }}</strong>
                              </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control {{($errors->first('password_confirmation') ? "border border-danger" : "")}}" 
                              id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                              @error('password_confirmation')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                              @enderror
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </div>

    <script>
      avatarInp.onchange = evt => {
        const [file] = avatarInp.files
        if (file) {
          avatar.src = URL.createObjectURL(file)
        }
      }
    </script>
@endsection