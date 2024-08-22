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

            {{ Auth::user()->name }} - {{ __('Cart') }}

						
                        @if (Session::has('message'))
						<div style="margin-top: 0px; margin-bottom: 60px;" class="title-sm style2">
							<p style="color: #000; font-size: 16px;">
								{{ Session::get('message') }}
							</p>
						</div>
						@endif

            <h2>Cart Summary</h2>
            
            <?php
            /*
            <form class="form-horizontal"  method="post" action="{{ url('/addcart') }}" >
                {{ csrf_field() }}  

                <div class="row col-lg-12">

                    <div class="col-lg-6">
                        <label style="margin-top: 10px; color: #50a8af;">Customer</label>
                        <select name="customer" class="form-control">
                            <?php foreach ($cagent as $cus) { ?>
                                <option value="{{ $cus->customer_id }}" > {{ $cus->company }} </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <input  type="text" class="form-control" value={{$bookID}} name="bookID" hidden/>
                        <input  type="text" class="form-control" value={{$price}} name="bookPrice" hidden/>
                        <input  type="text" class="form-control" value={{$salesAgent}} name="salesAgent" hidden/>
                        <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                            <span style="font-weight: 700">Add to Cart</span>
                        </button>
                    </div>
                </div>
                
            </form>   

            */
            ?>


            <div style="margin-top: 40px;" class="row col-lg-12">
                <div class="col-lg-6">
                @if($cartDetails)
                    
                    <table>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Sub-Total</th>
                            <th>Update</th>
                            <th>Remove</th>
                        </tr>

                        <?php foreach($cartDetails as $carD){ ?>
                        <tr>
                            <form class="form-horizontal"  method="post" action="{{ url('/updatecart') }}" >
                                {{ csrf_field() }}  

                                <td>{{ $carD['title'] }}</td>
                                <td>
                                    <input  type="number" min="1"  class="form-control" value={{$carD['qty']}} name="qty"/>
                                </td>
                                <td>N{{ number_format($carD['price'], 2) }}</td> 
                                <td>N{{ number_format($carD['subtotal'], 2) }}</td>
                                <td>
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                            <input  type="text" class="form-control" value={{$carD['item']}} name="item" hidden/>
                                            <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                            <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                                                <span style="font-weight: 700">Update Cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </form> 
                            
                            <form class="form-horizontal"  method="post" action="{{ url('/removecartitem') }}" >
                                {{ csrf_field() }}  
                                <td>
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                            <input  type="text" class="form-control" value={{$carD['item']}} name="item" hidden/>
                                            <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                            <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                                                <span style="font-weight: 700">Remove</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </form>
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

                        <form class="form-horizontal"  method="post" action="{{ url('/checkout') }}" >
                            {{ csrf_field() }}  
                            <td>
                                <div class="row col-lg-12">
                                    <div class="col-lg-6">
                                        <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                        <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                        <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                                            <span style="font-weight: 700">Checkout</span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </form>

                    </div>

                @endif
                </div>

            </div>




        </div>
    </body>
</html>