@extends('layouts.app')

@section('contents')
    <div class="row m-0 p-0 justify-content-center align-items-center h-100 my-3">
        <div class="col-sm-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="login-header d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title text-center text-white">Message History</h5>
                        <p class="card-text text-center text-white">Here is you message history.</p>
                    </div>

                    <div id="messenger-body" class="messenger-history py-3">
                        <ul id="message-list">
                            @if (count($messages) == 0)
                              <li class="text-center text-danger">
                                  No Conversiont
                              </li>
                            @endif
                            @foreach ($messages as $message)
                            <li class="message question">
                                <div class="message-content bg-secondary p-1 rounded text-white">
                                    <p class="message-text mb-0">{{ $message->question }}</p>
                                    <small class="message-time">{{ date('d M, Y | h:i a', strtotime($message->created_at)) }}</small>
                                </div>
                                <div class="avatar-wrapper rounded-circle ms-1">
                                  @if (Auth::user()->avatar)
                                      <img src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="" srcset="">
                                  @else 
                                    <i class="bi bi-person"></i>
                                  @endif
                                </div>
                            </li>
                            <li class="message reply">
                                <div class="avatar-wrapper rounded-circle me-1">
                                  <i class="bi bi-person"></i>
                                </div>
                                <div class="message-content bg-info p-1 rounded text-white">
                                    <p class="message-text mb-0">{{ $message->answer }}</p>
                                    <small class="message-time">{{ date('d M, Y | h:i a', strtotime($message->created_at)) }}</small>
                                </div>
                            </li>
                            @endforeach
                            <!-- Add more question and reply messages here -->
                        </ul>
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
  $( document ).ready(function() {
    $("#messenger-body").animate({ scrollTop: $('#messenger-body').prop("scrollHeight")}, 1000);
  });
</script>
@endsection