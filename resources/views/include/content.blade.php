

<div id="wrap" class="boxed ">
  <div class="container-p-75 grey-bg" > <!-- Grey BG  -->	
     <div class="page-section indent-header">
      <div class="relative">
        <h5 class="widget-title" style="color: rgb(72, 99, 160);">Categories</h5>	
        <div class="row mb-30" >
          <div class="owl-clients-nav owl-carousel owl-arrows-bg" >
            <?php foreach ($categories as $category): ?> 
            <div class="item m-bot-0 text-center"><a href="/categories/{{$category->inct_hash}}" class="widget-title">{{$category->cat_name}}<br><img src="/images/category/{{$category->img_path}}" alt="img"></a></div>
             <?php endforeach; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>  

<!-- CONTENT -->
<div class="page-section p-100-cont" >
  <div class="container">
    <div class="row">
      
        <!-- CONTENT -->
        <div class="row">
          <div class="col-sm-9">
            <div class="widget">
              <form class="form-search widget-search-form" action="/search" method="get">
                <input type="text" name="product_details" class="input-search-widget" placeholder="Search">
                <button class="" type="submit" title="Start Search">
                  <span aria-hidden="true" class="icon_search"></span>
                </button>
              </form>
            </div>
          </div>
          
          <div class="col-sm3">
            <div class="right">
                <form method="get" action="/sortbyprice/inct_hash" class="form">
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
        
        <div class="row" >
          <!-- SHOP Item -->
          <?php foreach ($content as $products): ?>
          <div class="col-md-2 col-lg-2 pb-80 card" >
            <div class="post-prev-img">  
              <a href="/productdetails/{{$products->inmr_hash}}"><img style="height: 250px; width: auto" src="/images/products/{{$products->image_path}}" alt="img"></a>
            </div>
            
            <div class="post-prev-title mb-5">
              <h3><a class="font-norm a-inv" href="/productdetails/{{$products->inmr_hash}}">{{$products->product_details}}</a></h3>
            </div>
              
            <div class="shop-price-cont" data-price={{ $products->cost_amt }}>
              <strong>&#8369; {{ number_format($products->cost_amt, 2) }}</strong>
            </div>
          </div>

          <?php endforeach; ?>        
          
          
        </div>
                        
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
