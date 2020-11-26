@extends('pages.index')

@section('content')
    <!-- PAGE TITLE -->
    {{-- <div class="page-title-cont page-title-small grey-light-bg">
        <div class="relative container align-left">
          <div class="row">
            
            <div class="col-md-8">
              <h1 class="page-title">MY CART</h1>
            </div>
            
            <div class="col-md-4">
              <div class="breadcrumbs">
              </div>
            </div>
            
          </div>
        </div>
      </div> --}}
      
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
                  <div class="col-md-12">
                    
                    <div class="table-responsive">
                      <form id="checkout-form">
                      <table class="table table-striped shopping-cart-table">
                      <thead>
                        <tr>
                        <th>&nbsp;<input type="checkbox" class="tbl_selectAll"></th>
                        <th></th>
                        <th></th>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                        <th>ACTION</th>
                        </tr>
                      </thead>
                      
                        <?php 
                        $unit_total = 0;
                        $sub_total = 0;
                        $shipping = 0;
                        $order_total = 0;
                         ?>
                        <?php 
                        if(count($data['mycart']) > 0){
                          foreach ($data['supplier'] as $sumr): 
                         ?>
                         <tbody>
                      <tr>
                          <td colspan="8">&nbsp;<input type="checkbox"  class="selectAll"> {{$sumr->seller_name}}</td>
                      </tr>
                          <?php 
                            foreach ($data['mycart'] as $addcart):
                            if($addcart->sumr_hash == $sumr->sumr_hash)
                            {
                            $unit_total =$addcart->unit_price * $addcart->qty; 
                            // $sub_total +=$unit_total; 
                            // $shipping =$sub_total * 0.05;
                            // $order_total = $sub_total +$shipping; 
                          ?>
                          <tr>
                          <td></td>
                          <td class="text-center">
                          <input name="is_selected"  type="checkbox" data-srln-hash="{{ $addcart->srln_hash }}" value={{ $unit_total }} class="items" {{ ($addcart->is_selected == 1 ? ' checked' : '') }}>
                          </td>
                          <td><a href="/productdetails/{{$addcart->inmr_hash}}"><img style="height: 60px; width: 45px;" src="/images/products/{{$addcart->image_path}}" alt="img"></a></td>
                          <td><a href="/productdetails/{{$addcart->inmr_hash}}" >{{ $addcart->product_name }}</a></td>
                          <td>{{ number_format($addcart->unit_price, 2) }}</td>
                          <td>
                          <input type="number" id="line_qty_{{ $addcart->srln_hash }}" data-orig-price="{{ $addcart->unit_price }}" data-srln-hash="{{ $addcart->srln_hash }}"  class="input-border white-bg qty" style="width: 70px; " min="1" max="100" value={{ $addcart->qty }}>
                          </td>
                        <td><div class="font-black" id="line_total_price_{{ $addcart->srln_hash }}"> {{ number_format($unit_total, 2) }} </div></td>
                          <td><a  href="/delete/{{ $addcart->srln_hash }}"><span aria-hidden="true" class="icon_close_alt2"></span></a>  </td>
                           </tr>
                        
                      <?php }?> {{-- END OF SAME SELLER/SUPLIER --}}
                      <?php endforeach; ?> {{-- END OF CART --}}
                      <?php endforeach; ?> {{-- END OF SUPPLIER --}}
                      <?php }else{ ?>
                        <tr>
                          <td colspan="8">
                            <center>YOUR SHOPPING CART IS EMPTY</center><br>
                            <center><a href="/" class="button medium blue w-100-767">SHOP NOW!</a></center>
                          </td>
                        </tr>
                      </tbody>
                      <?php }?>
                      </table>
                      </form>
                    </div>
                  </div>
                
                </div>
          
          <!-- DIVIDER -->
          <hr class="mt-0 mb-30">
          
          <div class="row">
          
            <div class="col-sm-6">
              <form action="#" class="form">
                <div class="row">
                
                  <div class="col-sm-6 mb-10">
                    <input placeholder="COUPON CODE" class="input-border w-100" type="text" required="">
                  </div>
                    
                  <div class="col-sm-6 mb-30">  
                    <button type="submit" class="button medium gray-light w-100-767">APPLY CODE</button>
                  </div>
                  
                </div>
              </form>
            </div>
            
            <div class="col-sm-6 text-right text-center-767 mb-30" style="color: black">
                   <span class="font-norm1" style="font-size:20px">CART SUBTOTAL:</span> <strong style="font-size:22px" >&#8369; <strong id="subtotal" > </strong></strong>&nbsp;
                   <button type="submit"  id="btn_checkout" class="button medium blue w-100-767">PROCEED TO CHECKOUT</button> 
                   {{-- <button type="button" id="btncheck" class="button medium gray w-100-767" >
                    <span class=""></span> <label class="btncheck_label">PROCEED TO CHECKOUT</label> --}}
                </button>
            </div>
            
          </div>

          <!-- DIVIDER -->
          <hr class="mt-0 mb-60">
        </div>
      </div>
   
@stop

@section('embeddedjs')
<script src="/formatter/accounting.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  var computeItems;
  
  var initializeControls = function() {
        $('.row-error').hide();
        $('.row-success').hide();
        $('.div_success').hide();

        var UpdateCheck = (function(srln_hash,is_selected){
            var _data=$('#').serializeArray();

            _data.push({name : "srln_hash" ,value : srln_hash});
            _data.push({name : "is_selected" ,value : is_selected});

             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            return $.ajax({
                "dataType": "json",
                "type": "POST",
                "url": "{{ url('/cart/updatestatus') }}",
                "data": _data
            });
        });

       computeItems = function(){
        $('#subtotal').text("");
        var subtotal = 0; 
        var is_selected;

          $('.items').each(function () {
          var srln_hash=$(this).data("srln-hash");

            if (this.checked) {

              var qty = $('#line_qty_'+srln_hash).val();
              var orig_price = $('#line_qty_'+srln_hash).data("orig-price"); 
              total_line_price = parseFloat(qty * orig_price);

              subtotal += parseFloat(total_line_price);
              is_selected = 1;
            }else{
              is_selected = 0;
            }

            UpdateCheck (srln_hash,is_selected);

          });

          $('#subtotal').text(accounting.formatNumber(subtotal,2));
      };
      computeItems();
    }();

        



    $('#btn_checkout').click(function() {
        
      if (!jQuery('.items').is(":checked")) {
        alert("You Have Not Selected Any Items For Checkout");
        return false;
    }else{
    window.location.href = "/checkout";
  }
    });

      $('.selectAll').on('change', function(){
          $(this).parents('tbody').find('.items').prop('checked', this.checked);
          computeItems();
      }); 

      $('.tbl_selectAll').on('click', function(){
        var status = $(this).is(":checked");
        $('.selectAll').prop('checked', status);
        $('.selectAll').trigger("change");
      });

    // IF CHECKBOX IS CHECKED GET THE SUBTOTAL
    $('.items').on('change', function () {
        // var qty = $(this).val();
        computeItems();
    });

    var UpdateQty = (function(srln_hash,qty){
            var _data=$('#').serializeArray();

            _data.push({name : "srln_hash" ,value : srln_hash});
            _data.push({name : "qty" ,value : qty});

             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            return $.ajax({
                "dataType": "json",
                "type": "POST",
                "url": "{{ url('/cart/updateqty') }}",
                "data": _data
            });
        });

    $('.qty').on('change', function () {
        var srln_hash = $(this).data("srln-hash");
        var orig_price = $(this).data("orig-price");
        var qty = $(this).val();

        if (qty >= 1){
          total_line_price = parseFloat(qty * orig_price);

        }else{
          $(this).val(1);
          alert("QUANTITY MUST BE EQUAL TO OR GRATER THAN 1");
          qty = 1;
          total_line_price = parseFloat(1 * orig_price);
        }

        $('#line_total_price_'+srln_hash).html(parseFloat(total_line_price));
        UpdateQty (srln_hash,qty);
        computeItems();
    });
    
  

  });




  </script>
  @endsection