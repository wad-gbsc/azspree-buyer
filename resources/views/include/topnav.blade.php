<header id="nav" class="header header-1 mobile" style="background-color:rgb(63, 224, 208);">
          
    {{-- <div class="header-wrapper"> --}}
      <div >
      <div class="container-m-30 clearfix">
        <div class="logo-row">
          <!-- LOGO --> 
          <div class="logo-container-2">
            <div class="logo-2">
              <a href="/" class="clearfix">
                <img src="/brands_try/azspreelogo.png" class="logo-img" alt="Azspree">
                {{-- <label>AZSPREE</label> --}}
              </a>
            </div>
          </div>
          <!-- BUTTON --> 
          <div class="menu-btn-respons-container">
              <button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#main-menu .navbar-collapse">
                  <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
              </button>
          </div>
       </div>
      </div>

      <!-- MAIN MENU CONTAINER -->
      <div class="main-menu-container">
          
            <div class="container-m-30 clearfix">	
            
                  <!-- MAIN MENU -->
                  <div id="main-menu" style="background-color:rgb(63, 224, 208);">
                    <div class="navbar navbar-default" role="navigation">

                      <!-- MAIN MENU LIST -->
                      <nav class="collapse collapsing navbar-collapse right-1024">
                        <ul class="nav navbar-nav">
                        
        <!-- MENU ITEM -->
        <li ><a href="/"><div style="color:black" class="main-menu-title">HOME</div></a></li>

        <!-- MENU ITEM -->
        <li>
          <a href="https://forms.gle/UfJ6y8Hprq6YGv847"><div style="color:black" class="main-menu-title">SELL ON AZSPREE</div></a>
        </li>					
        
        {{-- <!-- MENU ITEM -->
        <li>
          <a href="#"><div class="main-menu-title">MY CART</div></a>
        </li>					
        
        <!-- MENU ITEM -->
        <li>
          <a href="#"><div class="main-menu-title">CHECK OUT</div></a>
        </li>	 --}}

        {{-- <!-- MENU ITEM -->
        <li>
          <a href="/signup"><div class="main-menu-title">SIGN UP</div></a>
          
        </li> --}}
        
        <!-- MEGA MENU ITEM -->
        {{-- <li>
          <a href="/trackorder"><div class="main-menu-title">TRACK ORDER</div></a>
          
        </li>					 --}}
        
        {{-- <!-- MENU ITEM -->
        <li id="menu-contact-info-big" class="parent megamenu">
          <a href="#"><div class="main-menu-title">CONTACT</div></a>
          
        </li> --}}
      
        <!-- MENU ITEM -->
        {{-- <li id="menu-cart" >
          <a href="/mycart"><div class="main-menu-title"><span aria-hidden="true" class="icon_cart"></span>CART (0)</div></a>
        </li> --}}

        <!-- MENU ITEM -->
        <?php if(Session::has('user_hash')){ ?>
          <li id="menu-cart">
            {{-- <a href="/mycart"><div class="main-menu-title"><span aria-hidden="true" class="icon_cart"></span>CART ({{ session('total_qty') }})</div></a> --}}
            <a href="/mycart"><div style="color:black" class="main-menu-title"><span aria-hidden="true" class="icon_cart"></span>CART</div></a>
          </li>
      <?php }else{?>
          <li id="menu-cart"><a href="/mycart"><div style="color:black" class="main-menu-title"><span aria-hidden="true" class="icon_cart"></span>CART (0)</div></a></li>
      <?php }?>

        <!-- MENU ITEM -->
        <?php if(Session::has('user_hash')){ ?>
          <li class="parent">
            <a ><div style="color:black" class="main-menu-title"><span aria-hidden="true"class="fa fa-user"></span> {{ session('fullname') }}</div></a>
            <ul class="sub" style="background-color:rgb(63, 224, 208);">
              <li><a style="color:black" href="/profile">Profile</a> </li>
              <li><a style="color:black" href="/logout">Logout</a> </li>
            </ul>
          </li>
      <?php }else{?>
          <li ><a href="/login"><div style="color:black" style="color:black" class="main-menu-title">LOGIN</div></a></li>
      <?php }?>
      
        
                        </ul>
            
                      </nav>

                    </div>
                  </div>
                  <!-- END main-menu -->
                  
            </div>
            <!-- END container-m-30 -->
          
      </div>
      <!-- END main-menu-container -->
      
      <!-- SEARCH READ DOCUMENTATION -->
      {{-- <ul class="cd-header-buttons">
          <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
      </ul> <!-- cd-header-buttons -->
      <div id="cd-search" class="cd-search">
          <form class="form-search" id="searchForm" action="page-search-results.html" method="get">
              <input type="text" value="" name="q" id="q" placeholder="Search...">
          </form>
      </div>  --}}
      
    </div>
    <!-- END header-wrapper -->
    
  </header>