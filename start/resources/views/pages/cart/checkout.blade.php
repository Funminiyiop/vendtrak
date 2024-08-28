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
                        

                        @if($cartDetails)


                        <div>

                        
                            <form class="form-horizontal"  method="post" action="{{ url('/placeorder') }}" >
                                {{ csrf_field() }} 
                                
                                <div class="col-md-12 mt-2 mt-md-0">
                                    <div class="card card--grey">
                                        <div class="card-body">
                                            <h4>Payment Option</h4>
                                            <div class="row">
                                                <div class="col-md-6 mt-2 mt-md-0"">
                                                    <input id="paynow" type="radio" checked="checked" name="paymentchoice" value="paynow" class="radio" > 
                                                    <label for="paynow">{{ __('Pay Now (with Paystack)') }}</label>
                                                </div>
                                                <div class="col-md-6 mt-2 mt-md-0"">
                                                    <input id="paylater" type="radio" name="paymentchoice" value="paylater" class="radio"> 
                                                    <label for="paylater">{{ __('Pay Later') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2"></div>
                                </div>

                                <div class="col-md-12 mt-2 mt-md-0">
                                    <!-- h2 class="custom-color">ORDER SUMMARY</h2 -->
                                    <div class="cart-table cart-table--sm">
                                        <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                                            <div class="cart-table-prd-name"><b>Item</b></div>
                                            <div class="cart-table-prd-qty"><b>Qty</b></div>
                                            <div class="cart-table-prd-price"><b>Price</b></div>
                                            <div class="cart-table-prd-price"><b>Sub-total</b></div>
                                        </div>

                                        <?php foreach($cartDetails as $carD){ ?>
                                        <div class="cart-table-prd">
                                            <div class="cart-table-prd-name">
                                                <h2><a href="#">{{ $carD['title'] }}</a></h2>
                                            </div>
                                            <div class="cart-table-prd-qty">{{$carD['qty']}}</div>
                                            <div class="cart-table-prd-price">N{{ number_format($carD['price'], 2) }}</div>
                                            <div class="cart-table-prd-price">N{{ number_format($carD['subtotal'], 2) }}</div>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                    </div>

                                    
                                    <div class="card-total-sm">
                                        <div class="float-right">Sub-total: <span class="card-total-price">N{{ number_format($cartTotal, 2) }}</span></div>
                                    </div>
                                    <div class="card-total-sm">
                                        <div class="float-right">Vat (4%): <span class="card-total-price">N{{ number_format($vat, 2) }}</span></div>
                                    </div>
                                    <div class="card-total-sm">
                                        <div class="float-right">Total: <span class="card-total-price">N{{ number_format($total, 2) }}</span></div>
                                    </div>
                                    <div class="mt-2"></div>
                                </div>

                                <div class="col-md-12 col-lg-12">
                                    <div class="clearfix">
                                        <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                        <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                        <button type="submit" class="btn btn--lg w-100">Place Order</button>
                                    </div>
                                </div>
                                        
                            </form>

                        </div>


                        @endif
                        
                    </div>
                </div>
            </div>
        </div>


     		
@endsection