@extends('pages.index')

@section('embeddedcss')
@endsection

@section('content')
<div id="wrap" class="boxed ">
    <div class="grey-bg">
        <!-- Grey BG  -->
        <!-- PAGE TITLE -->
        {{-- <div class="page-title-cont page-title-small grey-light-bg">
            <div class="relative container align-left">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="page-title">{{ $data['products']->product_name }}</h1>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- CONTENT -->
        <div class="page-section p-140-cont">
            <div class="container">
                <div class="row">
                    <div class="">
                    <!-- ITEM PHOTO -->
                    <div class="col-md-4 col-sm-12 mb-50">

                        <div class="post-prev-img popup-gallery">
                            <a href="/images/products/{{$data['products']->image_path}}">
                                <img src="/images/products/{{$data['products']->image_path}}"
                                    alt="img"></a>
                        </div>
                        {{-- <div class="sale-label-cont">
                            <span class="sale-label label-danger bg-red">SALE</span>
                        </div> --}}

                        <div class="row">
                            <div class="popup-gallery">
                                {{-- yung 1 yun yung sumr_hash = seller and yung 2 naman inmr_hash = product id --}}
                                @foreach(File::glob(public_path('images/products/'.$data['products']->sumr_hash).'/'.$data['products']->inmr_hash.'/*') as $path)
                                <div class="col-xs-4 post-prev-img">
                                    <a href="{{ str_replace(public_path(''), '', $path) }}">
                                        <img src="{{ str_replace(public_path(''), '', $path ) }}" alt="img"></a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="col-md-7 col-sm-12 col-md-offset-1 mb-50">
                        <form id="add-form" autocomplete="off">

                           
                            
                            <h3><label class="mt-0 mb-30">{{ $data['products']->product_name }}</label></h3>
                            <input type="hidden" name="inmr_hash" id="inmr_hash" value="{{ $data['products']->inmr_hash }}" />
                            <input type="hidden" name="sumr_hash" id="sumr_hash" value="{{ $data['products']->sumr_hash }}" />
                            <input type="hidden" name="dimension" id="dimension" value="{{ $data['products']->dimension }}" />
                            <input type="hidden" name="weight" id="weight" value="{{ $data['products']->weight }}" />
                            <hr class="mt-0 mb-30">
                            <div class="row">

                                <div class="col-xs-4  mt-0 mb-30">
                                    {{-- <del>$130.00</del>
                                    --}}
                                    <strong><label class="item-price">&#8369; {{ number_format($data['products']->cost_amt, 2) }}</label></strong>
                                    <input type="hidden" name="cost_amt" value="{{ $data['products']->cost_amt }}" />
                                </div>

                                <div class="col-xs-8 text-right">
                                    <label style="color:rgb(72, 99, 160); font-size: 18px" >
                                        {{$data['products']->sales}} <span
                                        class="display-none-767">Sold</span>
                                        <span class="slash-divider">/</span> 
                                    </label>
                                    <label style="color:rgb(72, 99, 160); font-size: 18px">
                                         {{-- 4.8&nbsp; --}}
                                        <span >
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                          </span></label>
                                    <label style="color:rgb(72, 99, 160); font-size: 18px" ><span class="slash-divider">/</span>{{$data['products']->number_ratings}} <span
                                            class="display-none-767">Reviews</span>
                                    </label>
                                </div>

                            </div>

                            <div class="font-14 lh-20 mb-30">
                                {{-- <div>Brand: <label style="color:black; bold"></label></div> --}}
                                <div style="color:rgb(72, 99, 160); font-size: 18px" ><b>Shop: </b><label>{{ $data['products']->seller_name }}</label></div>
                                <div>Category: <label style="color:black">{{ $data['products']->cat_name }}</label>
                                    <span class="slash-divider">></span> <label style="color:black">{{ $data['products']->subcat_name }}</label>
                                </div>
                                <?php if ($data['products']->available_qty <= '0'){ ?> 
                                    <div style="font-size:14px" class="label label-danger">Out of Stocks.</div> 
                                <?php }else{ ?> 
                                    <div>Available: <label style="color:black">{{$data['products']->available_qty}}</label></div>
                                <?php }?>
                                
                                {{-- <div>Tags: <a class="a-dark" href="#">WOMEN'S
                                        SHOES</a>, <a class="a-dark" href="#">blue shirt</a>,
                                    <a class="a-dark" href="#">men</a></div>
                                <div>SKU: 8084</div> --}}
                            </div>

                            <hr class="mt-0 mb-30">

                            <div class="mb-30">
                                <label>{{ $data['products']->product_details }}</label><br>
                                <label>Length: {{ $data['products']->length }}</label><br>
                                <label>Width: {{ $data['products']->width }}</label><br>
                                <label>Height: {{ $data['products']->height }}</label><br>
                                <label>Weight: {{ $data['products']->weight }}</label><br>
                                {{-- Product Description --}}
                            </div>

                            <hr class="mt-0 mb-30">

                            <div class="row">
                                <div class="col-sm-6 mb-30">
                                        <select class="select-md input-border w-100" name="variant_1" data-msg-required="Please enter Size" required>
                                            <option>Select size</option>
                                            <option>XXL</option>
                                            <option>XL</option>
                                            <option>L</option>
                                            <option>M</option>
                                            <option>S</option>
                                        </select>
                                </div>

                                <div class="col-sm-6 mb-30">
                                        <select class="select-md input-border w-100" name="variant_2" data-msg-required="Please enter Color" required>
                                            <option>Select color</option>
                                            <option>Black</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                        </select>
                                </div>
                            </div>

                            <hr class="mt-0 mb-30">

                            <!-- ADD TO CART -->
                            <div class="row mb-30">
                                <div class="row row-error">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger animated shake">
                                            <span aria-hidden="true" class="alert-icon icon_blocked"></span>
                                            <span class="error_msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row div_success">
                                    <div class="col-md-12" style="align-content: center;">
                                        <div class="row row-success">
                                            <div class="col-md-12">
                                                <div class="alert alert-success animated fadeIn">
                                                    <span aria-hidden="true" class="alert-icon icon_like"></span>
                                                    <span class="success_msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form method="post" action="#" class="form">
                                    --}}
                            
                                        <div class="col-xs-4 col-sm-2 col-md-2 ">
                                             <input type="number" pattern=" 0+\.[0-9]*[1-9][0-9]*$" 
                                             <?php if ($data['products']->available_qty == '0'){ ?> disabled <?php   } ?>
                                             onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-msg-required="Please enter Quantity"
                                             min="1" max="100" class="input-border" name="qty" id="qty" value="1" required>
                                        </div>
                                        <div class="col-xs-8 col-sm-10 col-md-6">
                                            <div class="post-prev-more-cont clearfix">
                                                <div class="shop-add-btn-cont">
                                                    <button type="button" id="btnadd" data-user-id="<?php echo session('user_hash'); ?>" 
                                                        <?php if ($data['products']->available_qty == '0'){ ?> disabled <?php   } ?> 
                                                        class="btn btn-lg btn-primary" style="width: 100%;">
                                                        <span class=""></span> <label class="btnadd_label">ADD TO CART</label>
                                                    </button>
                                                </div>
                                                {{-- <div class="shop-sub-btn-cont">
                                                    <a href="#" class="post-prev-count"><span aria-hidden="true"
                                                            class="icon_heart_alt"></span></a>
                                                </div> --}}
                                            </div>
                                        </div>
                        
                            </div>
                        </form>

                    </div>

                </div>
                </div>
            </div>

            <hr class="mt-0 mb-80">

    <div class="container mb-100">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" >&nbsp;
                <h5 class="widget-title label label-primary" style="color: white">Product Reviews</h5>&nbsp;<br><br>
            <table class="table">
                <?php 
                if(count($data['order']) > 0){
                  foreach ($data['order'] as $review): 
                 ?>
            <tbody>
                <tr >
                    <td colspan="5">  
                      <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row" >
                                <div class="col-md-6">
                                  <b>{{$review->fullname}}</b><br>
                                  <span>Product: </span><span>{{$review->product_name}}</span>
                                </div>
                                <div class="col-md-6">
                                  <span style="color:rgb(72, 99, 160); float: right; font-size:20px">
                                    <?php 
                                    if ($review->rating == '1') {
                                    ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php }?>
                                    <?php 
                                    if ($review->rating == '2') {
                                    ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php }?>
                                    <?php 
                                    if ( $review->rating == '3') {
                                    ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php }?>
                                    <?php 
                                    if ($review->rating == '4') {
                                    ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php }?>
                                    <?php 
                                    if ($review->rating == '5') {
                                    ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <?php }?>
                                    
                                  </span><br>
                                </div>
                            </div>
                            <br><hr class="mt-0 mb-10">
                            <div class="row">
                              <div class="col-md-12" style="color:black;">
                                  {{$review->remarks}}
                              </div>
                          </div>
                      </div>
                    </div>    
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php }else{ ?>
                  <tr>
                    <td colspan="5">
                      <center>No Reviews Yet</center>
                      <br>
                    </td>
                  </tr>
              </tbody>
              <?php }?>
            </table>
            </div>
            </div>
        </div>
    </div>

            <div class="container mb-100">
                <div class="row row-success2">
                    <div class="col-md-12">
                            <div class="alert alert-success animated fadeIn">
                                <strong>Success!</strong>
                                <span class="success_msg"></span>
                            </div>
                    </div>
                </div>

                  <div class="row row-error2">
                    <div class="col-md-12" >
                        <div class="alert alert-danger animated shake contactError">
                            <strong>Error!</strong>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                  </div>
                <div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row" >
                        <div class="mb-30">&nbsp;
                            <h5 class="widget-title label label-primary" style="color: white">question(s)</h5>	
                          <ul class="media-list text comment-list">
                            <li>
                                <div class="contact-form-container">

                                    {{-- <form id="contact-form" action="#" method="POST"> --}}
                                    <form id="msg-form" autocomplete="off">
                                      <div class="row">
                                        <input type="hidden" name="inmr_hash" id="inmr_hash" value="{{ $data['products']->inmr_hash }}" />
                                      </div>
                                      
                                      <div class="row">
                                        <div>
                                          <div class="col-md-12 mb-40">
                                            <!-- <label>Message *</label> -->
                                            <br>
                                            <textarea style="resize: vertical;" maxlength="5000" data-msg-required="Please enter your message" rows="3" class="form-control" name="comment" id="comment" placeholder="ENTER YOUR QUESTION(S) HERE" required=""></textarea>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                          &nbsp;<input type="button" id="btnmsg" value="SEND MESSAGE" data-user="<?php echo session('user_hash'); ?>"  class="button medium blue" >
                                        </div>
                                      </div>
                                    </form>	
                                   
                                  </div>
                            </li>

                            <?php 
                            if(count($data['comment']) > 0){
                            foreach ($data['comment'] as $com): 
                            ?>
                            <!-- Comment Item -->
                            <li class="media comment-item">
                                <span style="text-align: center" class="label label-primary pull-left"><i class="icon_question_alt2"></i> QUESTION</span>&nbsp;
                                <div class="media-body">
                                                    
                                <div class="comment-item-title">
                                  <div class="comment-author">
                                   {{$com->fullname}}
                                    <span class="slash-divider">-</span><span class="comment-date" >{{$com->created_datetime}}</span>
                                  </div>
                                  <p class="pb-30">{{$com->comment}}</p>
                                </div>
                              </div>
                              <?php if($com->answer_status == '1'){ ?> 
                              <span style="text-align: center" class="label label-success pull-left"><i class="icon_check_alt2"></i>ANSWER</span>&nbsp;
                                <div class="media-body">
                                                    
                                <div class="comment-item-title">
                                  <div class="comment-author">
                                    {{$com->seller_name}}
                                    <span class="slash-divider">-</span><span class="comment-date" >{{$com->updated_datetime}}</span>
                                  </div>
                                  <p class="pb-30">{{$com->answer}}</p>
                                </div>
                              </div>
                              <?php }?> 
                            </li>
                            <!-- End Comment Item -->
                            <?php endforeach; ?>
                            <?php }else{ ?>
                            <li><center>No Comment Yet</center></li>
                            <?php }?>
                          </ul>
                        </div>
                            </div>
                        </div>
                    </div>
                        <!-- End Add Review -->
                              
                      </div>

                    <!-- PAGINATION -->
                    <div class="mt-0">
                        <nav>
                        {{ $data['comment']->links() }}
                        </nav> 
                    </div>
                </div>
                <!-- END tabs  -->
  
              </div>
            </div>

        </div>
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

    var initializeControls = function() {
        $('.row-error2').hide();
        $('.row-success2').hide();
    }();

    var validateRequiredFields = function(f) {
        var stat = true;

        $('.row-error').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]', f).each(function() {

            if ($(this).is('select')) {
                if ($(this).val() == 0 || $(this).val() == null) {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error').fadeIn(400);
                    $(this).focus();
                    stat = false;
                    return false;
                }
            } else {
                if ($(this).val() == 0 || $(this).val() == "") {
                // if ($(this).val() == "") {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error').fadeIn(400);
                    $(this).closest('.fg-line').addClass('has-error');
                    $(this).focus();
                    stat = false;
                    return false;
                }
            }

        });

        return stat;
    };

    var validateRequiredFields2 = function(f) {
        var stat = true;

        $('.row-error2').hide();
        $('div.form-group').removeClass('has-error');
        $('div.fg-line').removeClass('has-error');
        $('input[required],textarea[required],select[required]', f).each(function() {

                if ($(this).val() == 0 || $(this).val() == "") {
                // if ($(this).val() == "") {
                    $('.error_msg').html($(this).data('msg-required'));
                    $('.row-error2').fadeIn(400);
                    $(this).closest('.fg-line').addClass('has-error');
                    $(this).focus();
                    stat = false;
                    return false;
                }

        });

        return stat;
    };

    var AddCart = (function() {
        var _data = $('#add-form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
            "dataType": "json",
            "type": "POST",
            "url": "{{ url('/cart/create') }}",
            "data": _data
        });
    });

    $('#btnadd').click(function() {
        
        var user_hash = $(this).attr("data-user-id");

        if(user_hash == "" || null){
            window.location.href = "/login";
        }else{
            if (validateRequiredFields($('#add-form'))) {
            $(this).toggleClass('disabled');
            $(this).find('span').toggleClass('fa fa-spinner fa-spin');
            $('.btnadd_label').html('ADDING TO CART');  


            AddCart().done(function(response) {

                if (response.stat == "success") {
                    $('.div_success').show();
                    $('.success_msg').html(response.msg);
                    $('.row-success').fadeIn(400);
                    setTimeout(function() {
                        window.location.href = "/mycart";
                    },1000);
                } else {
                    $('.row-error').show();
                    $('.error_msg').html(response.msg);
                    $('.row-error').fadeIn(400);
                }
            })
            .always(function() {
                $('#btnadd').toggleClass('disabled');
                $('#btnadd').find('span').toggleClass('fa fa-spinner fa-spin');
                $('.btnadd_label').html('ADD TO CART');  
            });
            }
        }

    });


    var AddMsg = (function() {
        var _data = $('#msg-form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
            "dataType": "json",
            "type": "POST",
            "url": "{{ url('/cart/createmsg') }}",
            "data": _data
        });
    });

    $('#btnmsg').click(function() {
        
        var user_hash = $(this).attr("data-user");

        if(user_hash == "" || null){
            window.location.href = "/login";
        }else{
            if (validateRequiredFields2($('#msg-form'))) {

            AddMsg().done(function(response) {

                if (response.stat == "success") {
                    $('.row-success2').show();
                    $('.success_msg').html(response.msg);
                    $('.row-success2').fadeIn(400);
                    setTimeout(function() {
                        window.location.href = "/";
                    },1000);
                } else {
                    $('.row-error2').show();
                    $('.error_msg').html(response.msg);
                    $('.row-error2').fadeIn(400);
                }
            })
            }
        }

    });

    $('input').keypress(function(evt) {

        if (evt.keyCode == 13) {
            $('#btnadd').click();
        }

    });


    
</script>
@endsection

