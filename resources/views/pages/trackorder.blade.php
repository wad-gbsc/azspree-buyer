@extends('pages.index')

@section('content')
<div class="grey-light-bg clearfix">
    <!-- COTENT CONTAINER -->
    <div class="container white-bg plr-30 pt-30 pb-30 mt-80 mb-10 ">

        <div class="row mb-20">
            <div class="col-md-6">
                <div class="relative">

                    <div class="col-md-12" style="align-content: center;">
                        <div class="contact-form-cont" style="padding:40px;">
                            <!-- TITLE -->
                            <div class="mb-40">
                                <h2 class="bold" style="color: black; text-align:center ">TRACK YOUR <span
                                        style="color: rgb(57, 57, 199)">ORDER</span> </h2>
                                <label>Please enter your Order ID in the box below and press Enter. This was given to
                                    you on your receipt and in the confirmation email you should have received.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="relative">

                    <div class="col-md-12" style="align-content: center;">
                        <div class="contact-form-cont" style="padding:40px;">
                            <!-- TITLE -->
                            <div class="mb-40">
                                
                            </div><br><br>

                            <!-- Track order FORM -->
                            <div>
                                <form id="trackorder-form" autocomplete="off">

                                    <div class="row">
                                        <div class="col-md-12 mb-30">
                                            <label>Order Id</label>
                                            <input type="text" name="email" value=""
                                                data-msg-required="Please enter your Order Id" maxlength="100"
                                                class="controled" name="email" id="email" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-30">
                                            <label>Registered Email</label>
                                            <input type="text" name="email" value=""
                                                data-msg-required="Please enter your Registered Email" maxlength="100"
                                                class="controled" name="email" id="email" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center-xxs">
                                            <button type="button" class="button medium blue" id="btnto"
                                                style="width: 100%">
                                                TRACK ORDER
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@stop
