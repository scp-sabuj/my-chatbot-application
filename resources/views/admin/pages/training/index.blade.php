@php
    $type = app('App\Http\Controllers\Admin\Auth\AdminAuthController')->admin_role();
@endphp
@extends('layouts.app')

@section('contents')
    <div class="row m-0 p-0 justify-content-center align-items-center h-100 my-3">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body">
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

                    <div>

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button {{ $page == 'index' ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="{{ $page == 'index' ? 'false' : 'true' }}" aria-controls="collapseOne">
                                  Click To Train
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse {{ $page == 'index' ? '' : 'show' }} collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if ($page == 'index')
                                        <form action="{{ route($type.'.training.store') }}" method="post">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control {{($errors->first('question') ? "border border-danger" : "")}}" 
                                                    name="question" 
                                                    value="{{ old('question') }}" placeholder="Enter Question">
                                            </div>
                                            @error('question')
                                                <small class="text-danger mb-2" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control {{($errors->first('answer') ? "border border-danger" : "")}}" 
                                                    name="answer" 
                                                    value="{{ old('answer') }}" placeholder="Enter Answer">
                                            </div>
                                            @error('answer')
                                                <small class="text-danger mb-2" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                            <div class="text-center mt-2">
                                                <button type="submit" class="btn btn-primary w-100">Save</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ route($type.'.training.update', $data->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control {{($errors->first('answer') ? "border border-danger" : "")}}" 
                                                    name="question" 
                                                    value="{{ $data->question }}" placeholder="Enter Question">
                                            </div>
                                            @error('question')
                                                <small class="text-danger mb-2" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control {{($errors->first('answer') ? "border border-danger" : "")}}" 
                                                    name="answer" 
                                                    value="{{ $data->answer }}" placeholder="Enter Answer">
                                            </div>
                                            @error('answer')
                                                <small class="text-danger mb-2" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                            <div class="text-center mt-2">
                                                <button type="submit" class="btn btn-primary w-100">Update</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                              </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex mt-1">
                        <div class="bg-dark text-white  px-2 py-2 text-center w-100">Training History</div>
                        <div class="text-nowrap bg-dark text-white  px-2 py-2 text-center">Click Here To Train <i class="bi bi-arrow-right"></i></div>
                        <a class="btn btn-success" title="Click here to trained with updated data" 
                            href="{{ route($type.'.system-training') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    @if (Auth::guard('admin')->user()->role_id == 1)
                                        <th>Answered By</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($training_datas as $item)    
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $item->question }}</td>
                                        <td>{{ $item->answer }}</td>
                                        @if (Auth::guard('admin')->user()->role_id == 1)
                                            <td>{{ $item->admin_id == Auth::guard('admin')->user()->id ? 'You' : $item->admin->name }}</td>
                                        @endif
                                        <td>
                                            <span class="text-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td>{{ date('d M, Y | h:i a', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-dark" 
                                                    href="{{ route($type.'.training.edit', $item->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </a>
                                                <form class="mx-1" action="{{ route($type.'.training.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                
                                                    @method('DELETE')
                                                
                                                    <button type="submit" class="btn btn-danger ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                                @if ($item->status == 1)
                                                    <a class="btn btn-warning" 
                                                        href="{{ route($type.'.training.status-change', $item->id) }}" title="Make Inactive">
                                                        {{-- on --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
                                                            <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a class="btn btn-warning" 
                                                        href="{{ route($type.'.training.status-change', $item->id) }}" title="Make Active">
                                                        {{-- off --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                                            <path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection