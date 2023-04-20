@extends('layouts.app')

@section('contents')
    

{{-- documentation section start --}}
<div class="document-wrapper h-100">

  <div class="container my-4">
    @include('documentation')
  </div>

</div>
{{-- documentation section end --}}




{{-- message section start --}}
<button class=" btn btn-primary d-flex justify-content-center align-items-center rounded-circle messenger-btn" id="messenger-btn">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-messenger m-0 p-0" viewBox="0 0 16 16">
    <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
  </svg>
</button>

<div id="messenger-wrapper" class="d-flex flex-column justify-content-between  ">
  <div id="messenger-header">
    <button class="btn btn-transparent text-white back-arrow" id="back-arrow-btn">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
      </svg>
    </button>
    Messenger
  </div>
  <div id="messenger-body" class="h-100">
      <ul id="message-list" class="conversation">          
          @if (Auth::check())
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
          @else
            <li class="message reply">
                <div class="avatar-wrapper rounded-circle me-1">
                  <i class="bi bi-person"></i>
                </div>
                <div class="message-content bg-secondary p-1 rounded text-white">
                    <p class="message-text mb-0">Hi, I am chatbot. Made by Sabuj Chandra Paul.</p>
                    <small class="message-time">{{ date('d M, Y | h:i a') }}</small>
                </div>
            </li>
          @endif
      </ul>
  </div>
  <div id="messenger-footer" class="m-1">
      <div class="d-flex">
        @if (Auth::guard('admin')->check())
          <p class="m-0 text-danger">Login as a user or be guest. Your are loged in as an admin.</p>
        @else
          <textarea class="form-control text-msg" placeholder="Start Typing Here.." ></textarea>
          <button class="btn send-msg-btn" id="">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
              <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
            </svg>
          </button>
        @endif
      </div>
      <div class="text-danger err-msg"></div>
  </div>
</div>
{{-- message section end --}}

<script>
    function messengerShowHide() {
        var element = document.getElementById('messenger-wrapper');
        element.classList.toggle('d-none');
    }
    document.getElementById('messenger-btn').onclick=function(){
        messengerShowHide();
    }
    document.getElementById('back-arrow-btn').onclick=function(){
        messengerShowHide();
    }

</script>
@endsection

@section('extra-js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
  $( document ).ready(function() {
    $("#messenger-body").animate({ scrollTop: $('#messenger-body').prop("scrollHeight")}, 1000);

    //ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  });

  //send message usign ajax and receive response
  $(document.body).on("click",".send-msg-btn",function(){
    let message = $('.text-msg').val(); // get user given message

    //check if user given any empty or undefined value
    if ((message != '') && (typeof message  !== "undefined") ) {
      $('.text-msg').removeClass('border border-danger');
      $('.err-msg').text('');
      $.ajax({
          url: "{{ route('send.message') }}",
          type: "post", //send it through post method
          data: {
              message: message
          },
          success: function(data) {
            //if return successfully
            console.log(data);
            // console.log(data['response']);
            if (data['status'] == 404) {
                $('.err-msg').text(data['msg']);
            } else {
              let question = '<li class="message question">'+
                                '<div class="message-content bg-secondary p-1 rounded text-white">'+
                                    '<p class="message-text mb-0">'+message+'</p>'+
                                    '<small class="message-time">'+"{{ date('d M, Y | h:i a') }}"+'</small>'+
                                '</div>'+
                                '<div class="avatar-wrapper rounded-circle ms-1">'+
                                  '<i class="bi bi-person"></i>'+
                                '</div>'+
                            '</li>';
              let reply = '<li class="message reply">'+
                            '<div class="avatar-wrapper rounded-circle me-1">'+
                              '<i class="bi bi-person"></i>'+
                            '</div>'+
                            '<div class="message-content bg-info p-1 rounded text-white">'+
                              '<p class="message-text mb-0">'+data['response']+'</p>'+
                              '<small class="message-time">'+"{{ date('d M, Y | h:i a') }}"+'</small>'+
                            '</div>'+
                          '</li>';
              let final_que_rep = question + reply;
              
              $(".conversation").append(final_que_rep);
              $('.text-msg').val('');
              $("#messenger-body").animate({ scrollTop: $('#messenger-body').prop("scrollHeight")}, 1000);
            }
          },
          error: function (err) {
            //if return error
              if (err.status == 422) { // when status code is 422, it's a validation issue
                  var err_msg = '';
                  $.each(err.responseJSON.errors, function (i, error) {
                      err_msg = error[0];
                  });
                  $('.err-msg').text(err_msg);
                  $('.text-msg').addClass('border border-danger');
              }
          }
      });
    }else{
      $('.text-msg').addClass('border border-danger');
    }
  });
</script>
@endsection