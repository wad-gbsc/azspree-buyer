@extends('pages.index')

@section('content')
  
      
              <!-- CONTENT -->
              <div class="page-section p-140-cont">
        <div class="container">
                <div class="row mb-40">
                  <div class="row row-error">
                    <div class="col-md-12">
                        <div class="alert alert-danger nobottommargin">
                            <span aria-hidden="true" class="alert-icon icon_blocked"></span>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                </div>
                <div class="row div_success">
                    <div class="col-md-12" style="align-content: center;">
                        <div class="row row-success">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <span aria-hidden="true" class="alert-icon icon_like"></span>
                                    <span class="success_msg"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
          <!-- SHIPPING INFO -->
          <div id="payment_info">
            {{-- <div >
              <h3 class="mt-0 mb-50">&nbsp;</h3>
            </div> --}}
            <div >
              <h3 class="mt-0 mb-50">PAYMENT METHOD</h3>
            </div>
  
          <div class="row">
          
            <div class="col-sm-6">
              <div class="shipping-payment">
              {{-- <div class="grey-light-bg shipping-payment"> --}}
                
                <h4 class="blog-page-title mt-40 mb-25">PAYMENT DETAILS</h4>
                
                <form action="#" class="form">
                  <div class="mb-20">
                  <div class="row">
                    <div class="col-sm-6 mb-20">
                      <button type="button" disabled="disabled" class="button medium thin blue"
                      style="width: 100%;"> <span class=""></span> <label>COD</label>
                      </button>
                    </div>

                    <div class="col-sm-6 mb-20">
                      <button type="button" disabled="disabled" class="button medium thin blue"
                      style="width: 100%;"> <span class=""></span> <label>GCASH</label>
                      </button>
                    </div>

                    <div class="col-sm-6 mb-20">
                      <button type="button" disabled="disabled" class="button medium thin blue"
                      style="width: 100%;"> <span class=""></span> <label>ONLINE PAYMENT</label>
                      </button>
                    </div>
                    {{-- <div class="col-sm-6 mb-20">
                      <button type="button" class="btn btn-lg btn-primary" disabled="disabled">Primary button</button>
                    </div> --}}

                   
                    
                  </div>
                  </div>

                  <!-- DIVIDER -->
                  <hr class="mt-0 mb-60">

                  <div class="mb-0" style="text-align: right">
                    <a href="#payment_info" class="button medium blue w-100-767">PLACE YOUR ORDER</a> 
                    {{-- <input type="submit" value="CONTINUE TO PAYMENT" class="button medium gray" data-loading-text="Loading..."> --}}
                  </div>
                </form>
                
              </div>
            </div>
            <div class="row">       
              <div class="col-sm-5 col-md-offset-1 ">

                <h5 class="mt-60 mb-10" >
                  <span class="font-norm1">CART SUBTOTAL:</span> <strong style="font-size:20px" >&#8369; </strong>
                </h5> 
                
                <h5 class="mt-10 mb-10">
                  <span class="font-norm1">SHIPPING:</span> <strong style="font-size:20px">&#8369; <div id="shipping"></div></strong>
                </h5>
                
                 <!-- DIVIDER -->
                <hr class="mt-0 mb-10">

                <h3 class="mt-10 mb-100">
                  <span class="font-norm1">ORDER TOTAL:</span> <strong style="font-size:22px">&#8369; <div id="grandtotal"></strong>
                </h3>
            </div>
            
  
            </div>
            </div>
          
          </div>
          </div>
<br>
          <!-- DIVIDER -->
          <hr class="mt-0 mb-60">

        </div>
      </div>
   
@stop

@section('embeddedjs')
<script type="text/javascript">
 var initializeControls = function() {
        $('.row-error').hide();
        $('.row-success').hide();
        $('.div_success').hide();
    }();
 


  </script>
  @endsection