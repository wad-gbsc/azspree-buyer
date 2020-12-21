@extends('pages.index')
@section('content')
<div id="wrap" class="boxed ">
  <div class="container-p-75 grey-bg"> <!-- Grey BG  -->	
     <div class="page-section indent-header">
      <div class="relative">
        <h5 class="widget-title">Categories</h5>	
        <div class="row mb-30" >
          <div class="owl-clients-nav owl-carousel owl-arrows-bg" >
            <?php foreach ($category as $categories): ?> 
            <div class="item m-bot-0 text-center"><a href="/categories/{{$categories->inct_hash}}" class="widget-title">{{$categories->cat_name}}<br><img src="/images/category/{{$categories->img_path}}" alt="img"></a></div>
             <?php endforeach; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>  

<!-- CONTENT -->
<div class="page-section p-100-cont">
  <div class="container">
    <div class="row">
      
      <!-- CONTENT -->
      <div class="row">
        <?php foreach ($cathash as $cat_hash): ?>
      <div class="col-sm-9">
        <div class="clearfix mb-0">
          <!-- SEARCH -->
        <div class="widget">
          {{-- <form class="form-search widget-search-form" action="/categories/{{$cat_hash->inct_hash}}/search" method="get"> --}}
            <form class="form-search widget-search-form" action="/searchcat" method="get">
            <input type="hidden" name="category" value={{$cat_hash->inct_hash}}>
            <input type="text" name="keyword" class="input-search-widget" placeholder="Search">
            <button class="" type="submit" title="Start Search">
              <span aria-hidden="true" class="icon_search"></span>
            </button>
          </form>
          </div>
        </div>
      </div>
          
      <form method="get" action="/sortbypricebycat" class="form">
        <div class="col-sm3">
          <div class="right">
            <input type="hidden" name="category" value={{$cat_hash->inct_hash}}>
                <select class="select-md form" name="sortbypricebycat" onchange="this.form.submit()">
                    <option selected disabled="disabled" selected="selected">Sort by Price</option>
                    <option value="desc">Price: High to Low</option>
                    <option value="asc">Price: Low to High</option>
                </select>
          </div>
        </div>
      <form>
      <?php endforeach; ?>

       
        </div>
        <?php
              foreach ($cat as $cat): 
             ?>
        <div>
          <center>
            <h1 class="widget-title">{{$cat->cat_name}}</h1>	
        </center>
        </div><br><br>
        <?php endforeach; ?> 
        <div class="row">

          <!-- SHOP Item -->
          <?php
          if(count($content) > 0){
          foreach ($content as $products):
          ?>
         <div class="col-md-2 col-lg-2 pb-80 card" >
          <div class="post-prev-img">  
            <a href="/productdetails/{{$products->inmr_hash}}"><img style="height: 250px; width: auto" src="/images/products/{{$products->image_path}}" alt="img"></a>
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
            <div>
              <h3>
                <center>No Result for this Category</center>
              </h3>
            </div>
            <?php }?>      
        </div>
                        
        <!-- PAGINATION -->
        <div class="mt-0">
          <nav class="blog-pag">
            {{ $content->links() }}
          </nav> 
        </div>
      </div>
    </div>
  </div>
</div>
@stop
