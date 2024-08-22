<!DOCTYPE html>
<html lang="en">
    <head>
        <title>E-Sales System</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
    </head>
    <body>
        <h2>E-Sales System</h2>
        
        <div></div>

        <div>

            {{ Auth::user()->name }} - {{ __('Checkout') }}

						
                        @if (Session::has('message'))
						<div style="margin-top: 0px; margin-bottom: 60px;" class="title-sm style2">
							<p style="color: #000; font-size: 16px;">
								{{ Session::get('message') }}
							</p>
						</div>
						@endif

            <h2>Cart Summary</h2>

            <div style="margin-top: 40px;" class="row col-lg-12">
                <div class="col-lg-6">
                @if($cartDetails)
                    
                    <table>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Sub-Total</th>
                        </tr>

                        <?php foreach($cartDetails as $carD){ ?>
                        <tr>
                            <td>{{ $carD['title'] }}</td>
                            <td>{{$carD['qty']}}</td> 
                            <td>N{{ number_format($carD['price'], 2) }}</td> 
                            <td>N{{ number_format($carD['subtotal'], 2) }}</td>
                        </tr>
                        <?php } ?>
                        
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Total: </th>
                            <th>N{{ number_format($cartTotal, 2) }}</th>
                        </tr>


                    </table>

                    <div class="col-lg-6">
                        <h3>Payment Choice</h3>

                        <form class="form-horizontal"  method="post" action="{{ url('/placeorder') }}" >
                            {{ csrf_field() }} 
                            
                            <div>
                                <label for="paynow" class="inline-flex items-center">
                                    <input id="paynow" type="radio" checked name="paymentchoice" value="paynow">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Pay Now (with Paystack)') }}</span>
                                </label> 
                            </div>
                            
                            <div>
                                <label for="paylater" class="inline-flex items-center">
                                    <input id="paylater" type="radio"  name="paymentchoice" value="paylater">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Pay Later') }}</span>
                                </label>
                            </div> 
                      

                            <div style="margin-top: 40px;" class="row col-lg-12">
                                <div class="col-lg-6">
                                    <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                    <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                    <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                                        <span style="font-weight: 700">Place Order</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                @endif
                </div>

            </div>




        </div>
    </body>
</html>