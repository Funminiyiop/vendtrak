<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions </title>
    <meta name="description" content="A book sales solution for authors and publishing firms">
    @include('layouts.headlinks')

</head>

@extends('layouts.skeleton')

@section('content')
        
        @if (Session::has('message'))
        <div class="holder mt-20">
            <div class="container">
                <div style="color: #000; font-size: 16px;" class="text-center">
                    <span>{{ Session::get('message') }}</span>
                </div>
            </div>
        </div>
        @endif

        <div class="holder mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside aside--left">
                        
                        @include('layouts.menuleft')

                    </div>

                    <?php  
                        
                    ?>
                    
                    <div class="col-md-9 aside">
                        <h3>Checkout</h3>
                        <div class="clearfix"></div>
                        

                        <div class="row">

                            <div class="col-md-4 mt-2 mt-md-0">
                                <div class="card card--grey">
                                    <div class="card-body">
                                        <h2>PAYMENT METHOD</h2>
                                        <div class="clearfix">
                                            <input id="formcheckoutRadio4" value="" name="radio2" type="radio" class="radio" checked="checked"> 
                                            <label for="formcheckoutRadio4">Pay with Credit Card (Paystack)</label>
                                        </div>
                                        <div class="clearfix">
                                            <input id="formcheckoutRadio5" value="" name="radio2" type="radio" class="radio"> 
                                            <label for="formcheckoutRadio5">Pay Later</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mt-2"></div>
                            </div>

                            <div class="col-md-8 mt-2 mt-md-0">
                                <!-- h2 class="custom-color">ORDER SUMMARY</h2 -->
                                <div class="cart-table cart-table--sm">
                                    <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                                        <div class="cart-table-prd-image"></div>
                                        <div class="cart-table-prd-name"><b>ITEM</b></div>
                                        <div class="cart-table-prd-qty"><b>QTY</b></div>
                                        <div class="cart-table-prd-price"><b>PRICE</b></div>
                                    </div>
                                    <div class="cart-table-prd">
                                        <div class="cart-table-prd-image"><a href="#"><img src="images/products/xsmall/product-05.jpg" alt=""></a></div>
                                        <div class="cart-table-prd-name">
                                            <h2><a href="#">Checkered shirt</a></h2>
                                        </div>
                                        <div class="cart-table-prd-qty"><b>1</b></div>
                                        <div class="cart-table-prd-price"><b>$ 75.00</b></div>
                                    </div>
                                    <div class="cart-table-prd">
                                        <div class="cart-table-prd-image"><a href="#"><img src="images/products/xsmall/product-02.jpg" alt=""></a></div>
                                        <div class="cart-table-prd-name">
                                            <h2><a href="#">Long top with print</a></h2>
                                        </div>
                                        <div class="cart-table-prd-qty"><b>1</b></div>
                                        <div class="cart-table-prd-price"><b>$ 20.00</b></div>
                                    </div>
                                    <div class="cart-table-prd">
                                        <div class="cart-table-prd-image"><a href="#"><img src="images/products/xsmall/product-14.jpg" alt=""></a></div>
                                        <div class="cart-table-prd-name">
                                            <h2><a href="#">Knitted sweater</a></h2>
                                        </div>
                                        <div class="cart-table-prd-qty"><b>1</b></div>
                                        <div class="cart-table-prd-price"><b>$ 199.00</b></div>
                                    </div>
                                </div>
                                <div class="card-total-sm">
                                    <div class="float-right">Subtotal <span class="card-total-price">$ 294.00</span></div>
                                </div>
                                <div class="mt-2"></div>
                            </div>

                            <div class="col-md-12 col-lg-12">
                                <div class="clearfix">
                                    <button type="submit" class="btn btn--lg w-100">Place Order</button>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>


     		
@endsection