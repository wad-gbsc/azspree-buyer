@extends('pages.index')

@section('content')
<div class="white-bg clearfix">    
    <!-- COTENT CONTAINER -->
    <div class="container white-bg mt-80 mb-10 " >
      <div class="row">
        <div class="col-md-12">
          <br>
          &nbsp;
          <br>
        </div>
      </div>

          <div class="col-md-6">
            <div class="relative">
              <div class="col-md-12" style="align-content: center;">
                  <div class="mt-80 mb-10">
                  <!-- TITLE -->
                  <div class="mb-40" style="text-align: center">
                    <img src="/brands_try/azspreelogo.png" class="" alt="Azspree">
                    <br><br><br><br>  
                    <button class="btn btn-primary" style="width: 80%" ><i class="fa fa-facebook" aria-hidden="true"></i> Login with Facebook</button>
                    <br>&nbsp;
                      <!-- DIVIDER -->
                      <hr class="mt-0 mb-10">
                      <br>&nbsp;
                    <button class="btn btn-danger" style="width: 80%" ><i class="fa fa-google" aria-hidden="true"></i> Login with Gmail</button>
                      {{-- <img src="/brands_try/azspree_logo.png" class="" alt="Azspree"> --}}
                    </a>
                  </div>
                  </div>
              </div>
            </div>
          </div>


          <div class="col-md-6">
            <div class="relative">
              <div class="col-md-12" style="align-content: center;">
                  <div class="mt-80 mb-10">
                    <!-- TITLE -->
                    <div class="mb-40">
                      <h2 class="bold" style="color:rgb(57, 57, 199)">LOG <span style="color:black">IN</span> </h2>
                      <label>Hello, Welcome to your account.</label>
                    </div>      
                    <!-- LOGIN FORM -->
                    <div>
                      <form id="login_form" autocomplete="off">
                        <div class="row row-error">
                          <div class="col-md-12">
                            <div class="alert alert-danger nobottommargin">
                              <span aria-hidden="true" class="alert-icon icon_blocked"></span><span class="msg">Invalid email or password.</span>
                            </div>
                          </div>
                        </div>
                        <div class="row row-success">
                          <div class="col-md-12">
                            <div class="alert alert-success">
                              <span aria-hidden="true" class="alert-icon icon_like"></span>Successfully Logged In.
                            </div>
                          </div>
                        </div>                  

                        <div class="row">
                          <div class="col-md-12 mb-30">
                            <!-- <label>Your name *</label> -->
                            <input type="text"  name="email" value="" data-msg-required="Please enter your email" maxlength="100" class="controled" name="email" id="email" placeholder="EMAIL" required>
                          </div>
                        </div>
                        
                        <div class="row">    
                          <div class="col-md-12 mb-30">
                            <input type="password"  name="password" value="" data-msg-required="Please enter your password" data-msg-password="Please enter a password" maxlength="100" class="controled" name="password" id="password" placeholder="PASSWORD" required>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12 text-center-xxs">
                              <button type="button" class="button medium blue" id="btnlogin" style="width: 100%">
                                Log In
                              </button>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <h5>Don't have an account? <a href="/signup" style="color:rgb(57, 57, 199)" ><u>Create an Account</u></a></h5>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <br>
                            &nbsp;
                            <br>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <br>
                            &nbsp;
                            <br>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <br>
                            &nbsp;
                            <br>
                          </div>
                        </div>
                      </form>	
                    </div>

                    {{-- <div id="otpdiv" >
                      <div class="form-group">
                        <label for="emotpail">OTP:</label>
                        <input type="otp" class="form-control" id="otp" placeholder="Enter OTP" name="otp">
                      </div>
                      <button id="otpSubmit" class="btn btn-primary">Submit</button>
                  </div> --}}

                  </div>
                </div>
            </div>
          </div>

    </div>
</div>
@stop
  
@section('embeddedjs')
<script type="text/javascript">

  var initializeControls = function(){
    $('.row-error').hide();
    $('.row-success').hide();
  }();

  var validateUser=(function(){
    var _data={email : $('input[name="email"]').val() , password : $('input[name="password"]').val()};    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    return $.ajax({
        "dataType":"json",
        "type":"POST",
        "url":"{{ url('/validatelogin') }}",
        "data" : _data
    });
  });

  var validateRequiredFields=function(f){
    var stat=true;

        $('.row-error').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                if($(this).val()==0 || $(this).val()==null){
                    $('.row-error').fadeIn(400);
                    $(this).focus();
                    stat=false;
                    return false;
                }
            
                }else{
                if($(this).val()==""){
                    $('.row-error').fadeIn(400);
                    $(this).closest('.fg-line').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }
            
        });

        return stat;
    };


  $('#btnlogin').click(function(){

    if(validateRequiredFields($('#login_form'))){
      validateUser().done(function(response){
        
          if(response.stat=="success"){
              $('.row-success').fadeIn(200);
              setTimeout(function(){
                  window.location.href = "/profile";
              },600);
          }else if (response.stat=="verify") {
            $('.row-verify').fadeIn(200);
              setTimeout(function(){
                  window.location.href = "/verify";
              },600);
          }else{
            $('.msg').html(response.msg);
            $('.row-error').fadeIn(200);
          }
      });
    }

  });

 
  $('input').keypress(function(evt){

    if(evt.keyCode==13){ $('#btnlogin').click(); }

  });

</script>
@endsection