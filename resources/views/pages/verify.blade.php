@extends('pages.index')

@section('content')
<div class="white-bg clearfix">    
    <!-- COTENT CONTAINER -->
    <div class="container white-bg mt-80 mb-10 " >

          <div class="col-md-3">
            <div class="relative">
            </div>
          </div>

          <div class="col-md-6">
            <div class="relative">
                      
              <div class="col-md-12" style="align-content: center;">
                  <div class="mt-80 mb-10">
                    <div class="row">
                      <div class="col-md-12">
                        <br>
                        &nbsp;
                        <br>
                      </div>
                    </div>
                    <!-- TITLE -->
                    <div class="mb-40">
                        <h2 class="bold" style="color: black">VERIFY YOUR <span style="color:rgb(57, 57, 199)">
                            ACCOUNT</span> </h2>
                    <label>Enter the Verification Code that sent on your registered email to log in.</label>
                    </div>
                                  
                    <!-- LOGIN FORM -->
                    <div>
                      <form id="verify_form" autocomplete="off">

                        <div class="row row-error">
                          <div class="col-md-12">
                            <div class="alert alert-danger nobottommargin">
                              <span aria-hidden="true" class="alert-icon icon_blocked"></span><span class="msg">Verification Code does not match. Please check code on Your email and try again.</span>
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
                            <input type="text" value="" data-msg-required="Please enter your verification code." class="controled" name="otp" id="otp" placeholder="VERIFICATION CODE" required>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12 text-center-xxs">
                              <button type="button" class="button medium blue" id="btnverify" style="width: 100%">
                                Submit
                              </button>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12 mb-30">
                           &nbsp;
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
                        <div class="row">
                          <div class="col-md-12">
                            <br>
                            &nbsp;
                            <br>
                          </div>
                        </div>
                      </form>	
                    </div>

                  </div>
                </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="relative">
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
    var _data={otp : $('input[name="otp"]').val()};    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    return $.ajax({
        "dataType":"json",
        "type":"POST",
        "url":"{{ url('/updateverification') }}",
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


  $('#btnverify').click(function(){

    if(validateRequiredFields($('#verify_form'))){
      validateUser().done(function(response){
        
          if(response.stat=="success"){
              $('.row-success').fadeIn(200);
              setTimeout(function(){
                  window.location.href = "/profile";
              },600);
          }else{
            $('span.msg').html(response.msg);
            $('.row-error').fadeIn(200);
          }
      });
    }

  });

 
  $('input').keypress(function(evt){

    if(evt.keyCode==13){ $('#btnverify').click(); }

  });

</script>
@endsection