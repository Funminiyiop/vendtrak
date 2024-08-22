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

            {{ Auth::user()->name }} - {{ __('Sales Rep: Books') }}

						
                        @if (Session::has('message'))
						<div style="margin-top: 0px; margin-bottom: 60px;" class="title-sm style2">
							<p style="color: #000; font-size: 16px;">
								{{ Session::get('message') }}
							</p>
						</div>
						@endif

            <h2>Book Details</h2>
            <div>
                <?php  
                    $bookID = $book->book_id; 
                    $price = $book->price;
                    $enp = number_format($price, 2);
                    $qty = $book->availableQty;
                    $title = $book->title;
                    $description = $book->description;
                    $salesAgent = Auth::user()->email;
                ?>
                <div>
                    <!-- div><a style="font-size: 16px;" href="{{ url('/order/'.$bookID) }}">Add to Cart</a></div -->
                    <div style="margin-top: 20px;"></div>
                    <!-- div><span style="margin-right: 20px;"><b>BookID</b></span>: {{ $bookID }} </div -->
                    <div><span style="margin-right: 20px;"><b>Price</b></span>: N{{ $enp }}</div>
                    <div><span style="margin-right: 20px;"><b>Available Qty</b></span>: {{ $qty }}</div>
                    <div><span style="margin-right: 20px;"><b>Title</b></span>: {{ $title }}</div>
                    <div><span style="margin-right: 20px;"><b>Description</b></span>: {{ $description }}</div>
                </div>
            </div>

            

                <div class="row col-lg-12">
                    <form class="form-horizontal"  method="post" action="{{ url('/addcart') }}" >
                        {{ csrf_field() }}  

                        <div class="col-lg-6">
                            <label style="margin-top: 10px; color: #50a8af;">Quantity</label>
                            <input  type="number" min="0" class="form-control" name="bookQty"/>
                        </div>
                        <!-- div class="col-lg-6">
                            <label style="margin-top: 10px; color: #50a8af;">Customer</label>
                            <select name="customer" class="form-control">
                                <?php foreach ($cagent as $cus) { ?>
                                    <option value="{{ $cus->customer_id }}" > {{ $cus->company }} </option>
                                <?php } ?>
                            </select>
                        </div -->
                        <div class="col-lg-6">
                            <?php 
                                $cusID = Session::get('table.customer'); 
                            ?>

                            <input  type="text" class="form-control" value={{$bookID}} name="bookID" hidden/>
                            <input  type="text" class="form-control" value={{$price}} name="bookPrice" hidden/>
                            <input  type="text" class="form-control" value={{$cusID}} name="customer" hidden/>
                            <input  type="text" class="form-control" value={{$salesAgent}} name="salesAgent" hidden/>
                            <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                                <span style="font-weight: 700">Add to Cart</span>
                            </button>
                        </div>
                    </form> 
                </div>
                

                <h3 style="margin-top: 40px;">Select Customer</h3>
                <div class="row col-lg-12">
                    <div>
                        <div>Selected Customer: 
                            <b>
                                <?php 
                                    if($sc === '' || $sc === NULL) { 
                                ?>
                                         No Customer Selected Yet.
                                <?php  } else { ?>
                                    {{ $sc }}.
                                <?php 
                                    }
                                ?>
                            </b>
                        <div>
                    </div>

                    <form class="form-horizontal"  method="post" action="{{ url('/selectcustomer') }}" >
                        {{ csrf_field() }}  
                        <div class="col-lg-6">
                            <label style="margin-top: 10px; color: #50a8af;">Customer</label>
                            <select name="customer" class="form-control">
                                <?php foreach ($cagent as $cus) { ?>
                                    <option value="{{ $cus->customer_id }}" > {{ $cus->company }} </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input  type="text" class="form-control" value={{$salesAgent}} name="salesAgent" hidden/>
                            <button type="submit" class="btn btn-info col-md-12 col-lg-12">                                
                                
                                <?php if($sc === '' || $sc === NULL) { ?>
                                    <span style="font-weight: 700">Select Customer</span>
                                <?php  } else { ?>
                                    <span style="font-weight: 700">Change Customer</span>
                                <?php } ?>

                            </button>
                        </div>
                    </form> 
                    
                    <div class="col-lg-6">
                        <a href="{{ url('/addcustomer') }}">
                            <button type="submit" class="btn btn-info col-md-12 col-lg-12">                                
                                <span style="font-weight: 700">Add Customer</span>
                            </button>
                        </a>
                        
                    </div>
                    
                </div>
                  

            

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
                            <td>{{ $carD['qty'] }}</td>
                            <td>{{ $carD['price'] }}</td>
                            <td>N{{ $carD['subtotal'] }}</td>
                        </tr>
                        <?php } ?>
                        
                    </table>

                </div>

                <div class="col-lg-6">
                    <a href="{{ url('/cart') }}">
                        <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                            <span style="font-weight: 700">View Cart</span>
                        </button>
                    </a>
                </div>
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
            </div>

            @endif



        </div>
    </body>
</html>