<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions</title>
    <meta name="description" content="A book sales solution for authors and publishing firms">
    @include('layouts.headlinks')

</head>

<body class="is-dropdn-click">
    
    @include('layouts.header')
    

    <div class="page-content">
        <!-- BN Slider 1 -->
        <div class="holder fullwidth full-nopad mt-0">
            <div class="container">
                <div class="bnslider-wrapper">
                    <div class="bnslider bnslider--lg bnslider--darktext keep-scale" id="bnslider-001" data-slick='{"arrows": true, "dots": true}' data-autoplay="false" data-speed="5000" data-start-width="1900" data-start-height="852" data-start-mwidth="900" data-start-mheight="852">
                        
                        <div class="bnslider-slide">
                            <div class="bnslider-image" style="background-image: url('images/home-electronics2/slider/slide-electronics2-1.png');"></div>
                            <div class="bnslider-text-wrap bnslider-overlay">
                                <div class="bnslider-text-content txt-middle txt-left">
                                    <div class="bnslider-text-content-flex container">
                                        <div class="bnslider-vert ml-0">
                                            <div class="bnslider-text bnslider-text--lg text-uppercase" data-animation="" data-animation-delay="0.2s" style="font-weight: 800">NEW</div>
                                            <div class="bnslider-text bnslider-text--xs text-uppercase" data-animation="" data-animation-delay="0.2s">gadgets & accessories</div>
                                            <div class="bnslider-text bnslider-text--xs" data-animation="" data-animation-delay="1.6s" style="font-size: 0.18em; margin-top: 2em;">FROM</div>
                                            <div class="bnslider-text bnslider-text--md" data-animation="" data-animation-delay="1.6s" style="font-size: 0.44em; color: #e53d60; margin-top: 0.4em;">$ 90.00</div>
                                            <div class="btn-wrap" data-animation="" data-animation-delay="2s"><a href="#" class="btn-decor btn-decor--lg">shop now<span class="btn-line"></span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>

        <!-- //BN Slider 1 -->
        <!--banners grid from the editor - Grid Layout 1 >
        <div class="holder mt-0 fullwidth full-nopad">
            <div class="container">
                <div class="row no-gutters justify-content-center">
                    <div class="col-md-12">

                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <a href="#" class="bnr-wrap">
                                    <div class="bnr bnr15 bnr--style-1-1 bnr--left bnr--top bnr-hover-scale" data-fontratio="5.33"><img src="images/placeholder.png" data-src="images/home-electronics2/banner-electronics2-1.png" class="lazyload" alt=""> 
                                        <span class="bnr-caption" style="padding: 12% 14%;">
                                            <span class="bnr-text-wrap">
                                                <span class="bnr-text3">Phones</span> 
                                                <span class="btn-decor btn-decor--xs btn-decor--whiteline bnr-btn">shop now
                                                    <span class="btn-line"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="#" class="bnr-wrap">
                                    <div class="bnr bnr16 bnr--style-1-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="5.33"><img src="images/placeholder.png" data-src="images/home-electronics2/banner-electronics2-2.png" class="lazyload" alt="">
                                        <span class="bnr-caption" style="padding: 5% 14%;">
                                            <span class="bnr-text-wrap">
                                                <span class="bnr-text3">discount<br>for Laptops</span> 
                                                <span class="btn-decor btn-decor--xs btn-decor--whiteline bnr-btn">shop now
                                                    <span class="btn-line"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="#" class="bnr-wrap">
                                    <div class="bnr bnr18 bnr--style-1-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="10.33"><img src="images/placeholder.png" data-src="images/home-electronics2/banner-electronics2-4.jpg" class="lazyload" alt=""> 
                                        <span class="bnr-caption" style="padding: 12% 14%;">
                                            <span class="bnr-text-wrap">
                                                <span class="bnr-text3">Gadgets</span> 
                                                <span class="bnr-text1">new arrivals</span> 
                                                <span class="btn-decor btn-decor--xs btn-decor--whiteline bnr-btn">shop now
                                                    <span class="btn-line"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div -->
        
        <!--banners grid from the editor -->
        <div class="holder">
            <div class="container">
                <div class="row vert-margin-double">

                    <div class="col-md-8">
                        <div class="title-with-left">
                            <h2 class="h1-style">Books</h2>
                        </div>
                        <div class="prd-grid data-to-show-3 data-to-show-md-2 data-to-show-sm-2 data-to-show-xs-2 js-product-isotope prd-text-center prd-grid--sm-pad">
                            <div class="prd prd-has-loader prd prd-sale prd-has-countdown">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="product.html" class="prd-img"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="{{url('./start/public/frame/images/products/product-30.jpg')}}" alt="Headphones JPL" class="js-prd-img lazyload"></a>
                                        <div class="label-sale">-45%</div><a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <ul class="list-options color-swatch prd-hidemobile">
                                            <li data-image="{{url('./start/public/frame/images/products/product-30.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="{{url('./start/public/frame/images/products/xsmall/product-30.jpg')}}" class="lazyload" alt="Color Name"></a></li>
                                            <li data-image="{{url('./start/public/frame/images/products/product-30-2.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="{{url('./start/public/frame/images/products/xsmall/product-30-2.jpg')}}" class="lazyload" alt="Color Name"></a></li>
                                        </ul>
                                        <div class="countdown-box">
                                            <div class="countdown js-countdown" data-countdown="2019/12/31"></div>
                                        </div>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#">JPL</a></div>
                                        <h2 class="prd-title"><a href="product.html">Headphones JPL</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 110.00</div>
                                            <div class="price-old">$ 200.00</div>
                                            <div class="price-comment">You save $ 90.00</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                            </div>
                                            <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                                <ul class="list-options size-swatch">
                                                    <li class="active"><span>xs</span></li>
                                                    <li><span>s</span></li>
                                                    <li><span>m</span></li>
                                                    <li><span>l</span></li>
                                                    <li><span>xl</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd-has-loader prd prd-sale prd-has-countdown">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="product.html" class="prd-img"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="{{url('./start/public/frame/images/products/product-31.jpg')}}" alt="Mapple Watch" class="js-prd-img lazyload"></a>
                                        <div class="label-sale">-16%</div><a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <ul class="list-options color-swatch prd-hidemobile">
                                            <li data-image="{{url('./start/public/frame/images/products/product-31.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="{{url('./start/public/frame/images/products/xsmall/product-31.jpg')}}" class="lazyload" alt="Color Name"></a></li>
                                            <li data-image="{{url('./start/public/frame/images/products/product-31-2.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="{{url('./start/public/frame/images/products/xsmall/product-31-2.jpg')}}" class="lazyload" alt="Color Name"></a></li>
                                        </ul>
                                        <div class="countdown-box">
                                            <div class="countdown js-countdown" data-countdown="2019/12/31"></div>
                                        </div>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#">mapple</a></div>
                                        <h2 class="prd-title"><a href="product.html">Mapple Watch</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 500.00</div>
                                            <div class="price-old">$ 600.00</div>
                                            <div class="price-comment">You save $ 100.00</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                            </div>
                                            <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                                <ul class="list-options size-swatch">
                                                    <li class="active"><span>xs</span></li>
                                                    <li><span>s</span></li>
                                                    <li><span>m</span></li>
                                                    <li><span>l</span></li>
                                                    <li><span>xl</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd-has-loader prd prd-featured">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="product.html" class="prd-img"><img src="{{url('./start/public/frame/images/products/product-placeholder.png')}}" data-srcset="images/products/product-27.jpg" alt="Sunsumg Galaxi S8" class="js-prd-img lazyload"> </a><a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <ul class="list-options color-swatch prd-hidemobile">
                                            <li data-image="images/products/product-27.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-27.jpg" class="lazyload" alt="Color Name"></a></li>
                                            <li data-image="images/products/product-27-2.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-27-2.jpg" class="lazyload" alt="Color Name"></a></li>
                                        </ul>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#">sunsumg</a></div>
                                        <h2 class="prd-title"><a href="product.html">Sunsumg Galaxi S8</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 600.00</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                            </div>
                                            <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                                <ul class="list-options size-swatch">
                                                    <li class="active"><span>xs</span></li>
                                                    <li><span>s</span></li>
                                                    <li><span>m</span></li>
                                                    <li><span>l</span></li>
                                                    <li><span>xl</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd-has-loader prd prd-new">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="product.html" class="prd-img"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-28.jpg" alt="Aphone" class="js-prd-img lazyload"></a>
                                        <div class="label-new">NEW</div><a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <ul class="list-options color-swatch prd-hidemobile">
                                            <li data-image="images/products/product-28.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-28.jpg" class="lazyload" alt="Color Name"></a></li>
                                            <li data-image="images/products/product-28-2.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-28-2.jpg" class="lazyload" alt="Color Name"></a></li>
                                        </ul>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#">mapple</a></div>
                                        <h2 class="prd-title"><a href="product.html">Aphone</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 900.00</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                            </div>
                                            <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                                <ul class="list-options size-swatch">
                                                    <li class="active"><span>xs</span></li>
                                                    <li><span>s</span></li>
                                                    <li><span>m</span></li>
                                                    <li><span>l</span></li>
                                                    <li><span>xl</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd-has-loader prd prd-new prd-featured">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="product.html" class="prd-img"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-29.jpg" alt="Sunsumg Galaxi Tab" class="js-prd-img lazyload"></a>
                                        <div class="label-new">NEW</div><a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <ul class="list-options color-swatch prd-hidemobile">
                                            <li data-image="images/products/product-29.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-29.jpg" class="lazyload" alt="Color Name"></a></li>
                                            <li data-image="images/products/product-29-2.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-29-2.jpg" class="lazyload" alt="Color Name"></a></li>
                                        </ul>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#">sunsumg</a></div>
                                        <h2 class="prd-title"><a href="product.html">Sunsumg Galaxi Tab</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 350.00</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                            </div>
                                            <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                                <ul class="list-options size-swatch">
                                                    <li class="active"><span>xs</span></li>
                                                    <li><span>s</span></li>
                                                    <li><span>m</span></li>
                                                    <li><span>l</span></li>
                                                    <li><span>xl</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prd prd-has-loader prd prd-new prd-sale prd-has-countdown">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="product.html" class="prd-img"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-32.jpg" alt="Sunsumg QLED" class="js-prd-img lazyload"></a>
                                        <div class="label-sale">-9%</div>
                                        <div class="label-new">NEW</div><a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <div class="countdown-box">
                                            <div class="countdown js-countdown" data-countdown="2019/12/31"></div>
                                        </div>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#">sunsumg</a></div>
                                        <h2 class="prd-title"><a href="product.html">Sunsumg QLED</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 900.00</div>
                                            <div class="price-old">$ 999.00</div>
                                            <div class="price-comment">You save $ 99.00</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                            </div>
                                            <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                                <ul class="list-options size-swatch">
                                                    <li class="active"><span>xs</span></li>
                                                    <li><span>s</span></li>
                                                    <li><span>m</span></li>
                                                    <li><span>l</span></li>
                                                    <li><span>xl</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-4">
                        <div class="vert-margin">
                            <!-- banners grid from the editor Banner19 --> 
                            <a href="#" class="bnr-wrap">
                                <div class="bnr bnr19 bnr--style-1-1 bnr--center bnr--bottom bnr-hover-scale" data-fontratio="3.23"><img src="images/placeholder.png" data-src="images/home-electronics2/banner-electronics2-5.png" class="lazyload" alt=""> <span class="bnr-caption" style="padding: 12% 14%;"><span class="bnr-text-wrap"><span class="bnr-text2">CAMERAS</span> <span class="bnr-text1">NEW ARRIVALS</span> <span class="btn-decor btn-decor--xs btn-decor--whiteline bnr-btn">shop now<span class="btn-line"></span></span></span></span></div>
                            </a>
                            <!-- //banners grid from the editor -->
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
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

    <div id="modalCheckOut" class="modal--checkout" style="display: none;">
        <div class="modal-header">
            <div class="modal-header-title">
                <i class="icon icon-check-box"></i><span>Product added to cart successfully!</span>
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalchk-prd">
                    <div class="row h-font">
                        <div class="modalchk-prd-image col"><a href="product.html"><img src="images/products/product-01.jpg" alt="Glamor shoes"></a></div>
                        <div class="modalchk-prd-info col">
                            <h2 class="modalchk-title"><a href="product.html">Glamor shoes</a></h2>
                            <div class="modalchk-price">$ 34.00</div>
                            <div class="prd-options"><span class="label-options">Sizes:</span><span class="prd-options-val">xs</span></div>
                            <div class="prd-options"><span class="label-options">Qty:</span><span class="prd-options-val">1</span></div>
                            <div class="prd-options"><span class="label-options">Color:</span><span class="prd-options-val">silver</span></div>
                            <div class="shop-features-modal d-none d-sm-block"><a href="#" class="shop-feature">
                                    <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                    <div class="shop-feature-text">
                                        <div class="text1">Delivery</div>
                                        <div class="text2">Lorem ipsum dolor sit amet conset</div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="shop-features-modal d-sm-none"><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">Delivery</div>
                                    <div class="text2">Lorem ipsum dolor sit amet conset</div>
                                </div>
                            </a></div>
                        <div class="modalchk-prd-actions col">
                            <h3 class="modalchk-title">There is <span class="custom-color">3</span> items in your cart</h3>
                            <div class="prd-options"><span class="label-options">Total:</span><span class="modalchk-total-price">$ 600.00</span></div>
                            <div class="modalchk-custom"><img src="images/payment/guaranteed.png" alt="Guaranteed"></div>
                            <div class="modalchk-btns-wrap"><a href="checkout.html" class="btn">proceed to checkout</a> <a href="#" class="btn btn--alt" data-fancybox-close>continue shopping</a></div>
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