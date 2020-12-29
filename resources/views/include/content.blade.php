

<div id="wrap" class="boxed ">
  <div class="container-p-75 grey-bg" > <!-- Grey BG  -->	
     <div class="page-section indent-header">
      <div class="relative">
        <h5 class="widget-title" style="color: rgb(72, 99, 160);">Categories</h5>	
        <div class="row mb-30" >
          <div class="owl-clients-nav owl-carousel owl-arrows-bg" >
            <?php foreach ($categories as $category): ?> 
            <div class="item m-bot-0 text-center"><a href="/categories/{{$category->inct_hash}}" class="widget-title" style="font-size: 20px;">{{$category->cat_name}}<br><img src="/images/category/{{$category->img_path}}" alt="img"></a></div>
             <?php endforeach; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>  

<!-- CONTENT -->
<div class="page-section p-100-cont pb-30 " >
  <div class="container">
    <div class="row">

      <!-- SHOP AD -->
      <div class="page-section" style="background-image: url('/brands_try/cabalen.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
        <div class="container">
          <div class="row">
          
            <div class="col-md-6 col-sm-6 p-40">
              <div class="equal-height">
                <div class="text-middle block-center-x-767">
                  {{-- <h3 class="light-34 m-0">HEY<br><span class="bold">GOOD DAY!</span></h3> --}}
                  {{-- <h3 class="light-34 m-0">NEW 2018 <br><span class="bold">COLLECTION</span></h3> --}}
                </div>
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6 text-center pt-40 pb-40 equal-height">
              <div class="equal-height">
                <div class="text-middle block-center-x-767">
                  {{-- <h3 class="light-34 m-0"><span class="bold">NOW</span> IN STORE</h3> --}}
                </div>
              </div>
            </div>

            {{-- <div class="col-md-4 col-sm-4 shop-ad-img">
              <div class="equal-height">
                <img  src="" sizes="10px" alt="img">
              </div>
            </div> --}}
            
            
          </div>            
        </div>            
      </div>

      
        <!-- CONTENT -->
        <div class="row mt-50">
          <div class="col-sm-9">
            <div class="widget">
              <form class="form-search widget-search-form" action="/search" method="get">
                <input type="text" name="keyword" class="input-search-widget" placeholder="Search">
                <button class="" type="submit" title="Start Search">
                  <span aria-hidden="true" class="icon_search"></span>
                </button>
              </form>
            </div>
          </div>
          
          <div class="col-sm3">
            <div class=" widget right">
                <form method="get" action="/sortbyprice" class="form">
                  {{-- {{ csrf_field() }} --}}
                    <select class="select-md form" name="sortbyprice" onchange="this.form.submit()">
                        <option selected disabled="disabled" selected="selected">Sort by Price</option>
                        <option value="desc">Price: High to Low</option>
                        <option value="asc">Price: Low to High</option>
                    </select>
                  </form>
            </div>
          </div>
        </div>
        
        {{-- <div class="row" style="background-color: rgb(217, 255, 255); "> --}}
          <div class="row" >
          <!-- SHOP Item -->
          <?php 
            if(count($content) > 0){
            foreach ($content as $products): ?>
          <div class="col-md-2 pb-30 pt-30" >
            <div>  
              <a href="/productdetails/{{$products->inmr_hash}}" ><img style="height: 250px;" src="/images/products/{{$products->image_path}}" alt="img"></a>
            </div>
            
            <div class="post-prev-title mb-5">
              <h3 style="text-overflow: ellipsis;
              white-space: nowrap;
              overflow: hidden;" ><a class="font-norm a-inv" href="/productdetails/{{$products->inmr_hash}}">{{$products->product_name}}</a></h3>
            </div>
              
            <div class="shop-price-cont" data-price={{ $products->cost_amt }}>
              <strong>&#8369; {{ number_format($products->cost_amt, 2) }}</strong>
            </div>
          </div>

          <?php endforeach; ?>      
          <?php }else{ ?>
            <div class="row">
                <div class="col-md-12 mb-110">
                    <h4><strong><center>No Result for this Product</center></strong></h4>
                </div>
                <div class="col-md-12 mb-110">
                </div>
                <div class="col-md-12 mb-110">
                </div>
            </div>
            <?php }?>    
        
                        
        <!-- PAGINATION -->
        <div class="mt-0" style="float: right;">
          <nav>
            {{ $content->links() }}
          </nav> 
        </div>
      </div>
    </div>
  </div>
</div>

@section('embeddedjs')
<script type="text/javascript">

$(document).on("change", ".control", function() {
  var sortingMethod = $(this).val();
  
  if(sortingMethod == 'l2h') {
    sortProductsPriceAscending();
  } else if (sortingMethod == 'h2l') {
    sortProductsPriceDescending();
  }
});

function sortProductsPriceAscending() {
  var gridItems = $('.grid-item');

  gridItems.sort(function(a, b) {
    return $('.shop-price-cont', a).data("price") - $('.shop-price-cont', b).data("price");
  });

  $(".isotope-grid").append(gridItems);
}

function sortProductsPriceDescending() {
  var gridItems = $('.grid-item');

  gridItems.sort(function(a, b) {
    return $('.shop-price-cont', b).data("price") - $('.shop-price-cont', a).data("price");
  });

  $(".isotope-grid").append(gridItems);
}
   
</script>
@endsection
