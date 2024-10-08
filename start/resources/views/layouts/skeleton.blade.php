

<body class="is-dropdn-click">
    
    @include('layouts.header')
    

    <div class="page-content">
    
        @yield('content')

    </div>

    @include('layouts.footer')
    


    <div class="modal--quickview" id="modalQuickView" style="display: none;">
        <div class="modal-header">
            <div class="modal-header-title">Quick View</div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="prd-block" id="prdGalleryModal">
                    <div class="prd-block_info">
                        <div class="prd-block_info-row info-row-1 mb-md-1">
                            <div class="info-row-col-1">
                                <h1 class="prd-block_title">Glamor shoes</h1>
                            </div>
                            <div class="info-row-col-2">
                                <div class="product-sku">SKU: <span>#0005</span></div>
                                <div class="prd-block__labels"><span class="prd-label--sale">SALE</span> <span class="prd-label--new">NEW</span></div>
                                <div class="prd-block_link"><a href="#" class="icon-heart-1"></a></div>
                            </div>
                        </div>
                        <div class="prd-block_info-row info-row-2">
                            <form action="#">
                                <div class="info-row-col-3">
                                    <div class="prd-block_price"><span class="prd-block_price--actual">$180.00</span> <span class="prd-block_price--old">$210.00</span></div>
                                </div>
                                <div class="info-row-col-4">
                                    <div class="prd-block_price"><span class="prd-block_price--actual">$180.00</span> <span class="prd-block_price--old">$210.00</span></div>
                                    <div class="prd-block_qty"><span class="option-label">Qty:</span>
                                        <div class="qty qty-changer qty-changer--lg">
                                            <fieldset><input type="button" value="&#8210;" class="decrease"> <input type="text" class="qty-input" value="2" data-min="0" data-max="10"> <input type="button" value="+" class="increase"></fieldset>
                                        </div>
                                    </div>
                                    <div class="prd-block_options">
                                        <div class="form-group select-wrapper-sm"><select class="form-control" tabindex="0">
                                                <option value="">36 / silver $34.00</option>
                                                <option value="">38 / silver $34.00</option>
                                                <option value="">36 / gold $45.00</option>
                                                <option value="">38 / gold $45.00</option>
                                            </select></div>
                                    </div>
                                    <div class="prd-block_actions">
                                        <div class="btn-wrap"><button class="btn btn--add-to-cart-sm"><i class="icon icon-handbag"></i><span>Add to cart</span></button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="prd-block_info js-prd-m-holder"></div><!-- Product Gallery -->
                    <div class="product-previews-wrapper">
                        <div class="product-quickview-carousel slick-arrows-aside-simple js-product-quickview-carousel">
                            <div><a href="images/products/large/product-01.jpg" data-fancybox="gallery"><img src="images/products/product-01.jpg" alt=""></a></div>
                            <div><a href="images/products/large/product-01-2.jpg" data-fancybox="gallery"><img src="images/products/product-01-2.jpg" alt=""></a></div>
                            <div><a href="images/products/large/product-01-3.jpg" data-fancybox="gallery"><img src="images/products/product-01-3.jpg" alt=""></a></div>
                            <div><a href="images/products/large/product-01-4.jpg" data-fancybox="gallery"><img src="images/products/product-01-4.jpg" alt=""></a></div>
                            <div><a href="images/products/large/product-01-5.jpg" data-fancybox="gallery"><img src="images/products/product-01-5.jpg" alt=""></a></div>
                        </div>
                        <div class="gdw-loader"></div>
                    </div>
                    <!-- /Product Gallery -->
                    <div class="mt-3 mt-md-4">
                        <h2>Description</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error expedita hic iure nemo, nihil quam. Ab blanditiis eligendi fugit impedit, magni minus omnis placeat recusandae rem, sunt ut vitae voluptates? Fuga pariatur provident reiciendis veritatis voluptates voluptatum. A accusantium aliquam amet deleniti ea esse ex minus obcaecati perferendis tempore? Cupiditate distinctio incidunt molestiae, nam nesciunt non quaerat quas ratione repellendus! Ab aperiam assumenda consequatur delectus ea exercitationem facilis, in itaque iusto labore maiores nemo nostrum odio officiis optio placeat quas qui quibusdam ratione rem soluta suscipit totam voluptas voluptatem voluptatum.</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <tbody>
                                    <tr>
                                        <td>FABRIC</td>
                                        <td>Metallic faux leather</td>
                                    </tr>
                                    <tr>
                                        <td>STYLE</td>
                                        <td>Goatskin lining, Strappy silhouette, Chunky heel, Buckle at ankle</td>
                                    </tr>
                                    <tr>
                                        <td>MANUFACTURE</td>
                                        <td>Made in Italy</td>
                                    </tr>
                                    <tr>
                                        <td>MATERIAL</td>
                                        <td>Rubber heel patch at leather sole</td>
                                    </tr>
                                    <tr>
                                        <td>WEIGHT</td>
                                        <td>0.05, 0.06, 0.07ess cards</td>
                                    </tr>
                                    <tr>
                                        <td>BOX</td>
                                        <td>This item cannot be gift-boxed</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCart" class="modal--checkout" style="display: none;">
        <div class="modal-header">
            <div class="modal-header-title">
                <i class="icon icon-check-box"></i><span>Cart Summary</span>
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalchk-prd">
                    <div class="row h-font">
                        <div class="container">

                        
                        
                        @if($cartDetails)


                        
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-order-history">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Sub-total</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; foreach($cartDetails as $carD){ ?>

                                        <tr>
                                            <th><?php echo $count+=1; ?></th>
                                            <td>{{ $carD['title'] }}</td>
                                            
                                            <form class="form-horizontal"  method="post" action="{{ url('/updatecart') }}" >
                                            {{ csrf_field() }}  
                                            
                                            <td>
                                                <input  type="number" min="1"  class="form-control" value={{$carD['qty']}} name="qty"/>
                                            </td>
                                            <td>N{{ number_format($carD['price'], 2) }}</td> 
                                            <td>N{{ number_format($carD['subtotal'], 2) }}</td>
                                            <td>
                                                <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                                <input  type="text" class="form-control" value={{$carD['item']}} name="item" hidden/>
                                                <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                                
                                                    <button style="width: 25%;" type="submit" class="btn icon-pencil"></button> 
                                                
                                            </form>
                                            </td>
                                            <td>
                                            <form class="form-horizontal"  method="post" action="{{ url('/removecartitem') }}" >
                                            {{ csrf_field() }} 
                                                <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                                <input  type="text" class="form-control" value={{$carD['item']}} name="item" hidden/>
                                                <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                                
                                                    <button style="width: 25%;" type="submit" class="btn icon-cross"></button> 
                                            </form>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>




                                
                            <div class="minicart-drop-total">
                                <div class="float-right">
                                    <span class="minicart-drop-summa">
                                        <span>Total:</span> 
                                        <b>N{{ number_format($cartTotal, 2) }}</b>
                                    </span>
                                </div>
                                <form class="form-horizontal"  method="post" action="{{ url('/checkout') }}" >
                                {{ csrf_field() }}  

                                <div class="float-left">
                                    <input  type="text" class="form-control" value={{$carD['agent']}} name="agent" hidden/>
                                    <input  type="text" class="form-control" value={{$carD['customer']}} name="customer" hidden/>
                                    <button type="submit" class="btn btn--alt">
                                        <i class="icon-handbag"></i>
                                        <span style="font-weight: 700">Checkout</span>
                                    </button>
                                </div>
                                </form>

                            </div>

                            @else


                            
                            <div class="minicart-prd">
                                <div>
                                    <h5>Your cart is empty</h5>
                                </div>
                            </div>

                            <div class="minicart-drop-total">
                                <div class="float-right">
                                    <span class="minicart-drop-summa">
                                        <span>Cart Total:</span> 
                                        <b>N0.00</b>
                                    </span>
                                </div>

                            </div>

                        @endif

                        

                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Page Preloader -->
    <div class="body-preloader">
        <div class="loader-wrap">
            <div class="dots">
                <div class="dot one"></div>
                <div class="dot two"></div>
                <div class="dot three"></div>
            </div>
        </div>
    </div>
    
    @include('layouts.footerlinks')
    
</body>

</html>