
@extends('pages.index')


@section('content')
    <div>
        @include('include.headboardpic')
        </div>

        <body style="overflow-x:hidden;">
           
            <div id="wrap" class="boxed ">
                <div class="grey-bg">

                    @include('include.content')
                    @include('include.sidebar')
                    @include('include.brands')
                    
                    
                </div>
            </div>
        </body>


   <div>
  
    
   </div>
   @stop

