<div class="body-preloader">
        <div class="loader-wrap">
            <div class="dots">
                <div class="dot one"></div>
                <div class="dot two"></div>
                <div class="dot three"></div>
            </div>
        </div>
    </div>
    <header class="hdr global_width hdr_sticky hdr-mobile-style2">
        <!-- Mobile Menu -->
        <div class="mobilemenu js-push-mbmenu">
            <div class="mobilemenu-content">
                <div class="mobilemenu-close mobilemenu-toggle">CLOSE</div>
                <div class="mobilemenu-scroll">
                    <div class="nav-wrapper show-menu">
                        <div class="nav-toggle">
                            <span class="nav-back">
                                <i class="icon-arrow-left"></i>
                            </span> 
                            <span class="nav-title"></span>
                        </div>
                        
                        @include('layouts.menumobile')

                    </div>
                </div>
            </div>
        </div>
        <!-- /Mobile Menu -->
        <div class="hdr-mobile show-mobile">
            <div class="hdr-content">
                <div class="container">
                    <div class="menu-toggle">
                        <a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a>
                    </div>
                    <div class="logo-holder">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{url('./start/public/frame/images/logo.png')}}" srcset="{{url('./start/public/frame/images/logo-retina.png 2x')}}" alt="">
                        </a>
                    </div>
                    <div class="hdr-mobile-right">
                        <div class="hdr-topline-right links-holder"></div>
                        <div class="minicart-holder"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="hdr-desktop hide-mobile">
            <div class="hdr-topline hdr-topline--dark">
                <div class="container">
                    <div class="row">

                        <div class="col-auto hdr-topline-left">
                            <!-- Header Social -->
                            <div class="hdr-line-separate">
                                <ul class="social-list">
                                    <li><a href="#" class="icon icon-facebook"></a></li>
                                    <li><a href="#" class="icon icon-twitter"></a></li>
                                    <li><a href="#" class="icon icon-google"></a></li>
                                    <li><a href="#" class="icon icon-instagram"></a></li>
                                    <li><a href="#" class="icon icon-youtube"></a></li>
                                </ul>
                            </div>
                            <!-- /Header Social -->
                        </div>

                        <div class="col hdr-topline-center">
                            <div class="custom-text"><span>FREE</span> DELIVERY ON ORDERS OVER N200,000.00</div>
                            <div class="custom-text"><i class="icon icon-mobile"></i><b>(+234) 07038310931 </b></div>
                        </div>

                        <div class="col-auto hdr-topline-right links-holder">
                            <!-- Header Search -->
                            <div class="dropdn dropdn_search hide-mobile @@classes">
                                <a href="#" class="dropdn-link"><i class="icon icon-search2"></i><span>Search</span></a>
                                <div class="dropdn-content">
                                    <div class="container">
                                        <form action="#" class="search">
                                            <button type="submit" class="search-button">
                                                <i class="icon-search2"></i>
                                            </button> 
                                            <input type="text" class="search-input" placeholder="search keyword">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Header Search -->
                            
                            <!-- Header Account -->
                            <div class="dropdn dropdn_account @@classes">
                                <a href="#" class="dropdn-link"><i class="icon icon-person"></i><span>My Account</span></a>
                                
                                <div class="dropdn-content">
                                    <div class="container">
                                        <div class="dropdn-close">CLOSE</div>

                                        <ul>
                                        @guest
                                            <li>
                                                <a href="{{ route('login') }}">
                                                    <i class="icon icon-lock"></i>
                                                    <span>{{ __('Login') }}</span>
                                                </a>
                                            </li>
                                            @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}">
                                                    <i class="icon icon-person-fill-add"></i>
                                                    <span>{{ __('Register') }}</span>
                                                </a>
                                            </li>
                                            @endif
                                        @else

                                            <li>
                                                <a href="{{ route('dashboard') }}">
                                                    <i class="icon icon-person-fill"></i>
                                                    <span>{{ __('Dashboard') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="icon icon-switch"></i>
                                                    <span>{{ __('Logout') }}</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        @endguest
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- /Header Account -->
                        </div>

                    </div>
                </div>
            </div>

            <div class="hdr-content hide-mobile">
                <div class="container">
                    <div class="row">
                        <div class="col-auto logo-holder">
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{url('/start/public/frame/images/logo.png')}}" srcset="{{url('/start/public/frame/images/logo.png')}}" alt="">
                            </a>
                        </div>
                        <!--navigation-->
                        <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                        <div class="nav-holder">
                            <div class="hdr-nav">
                                
                                @include('layouts.menudesktop')

                            </div>
                        </div>
                        <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
                        <!--//navigation-->
                        



                        @include('layouts.headercart')


                    </div>
                </div>
            </div>
        </div>


        <div class="sticky-holder compensate-for-scrollbar">
            <div class="container">
                <div class="row">
                    <a href="#" class="mobilemenu-toggle show-mobile"><i class="icon icon-menu"></i></a>
                    <div class="col-auto logo-holder-s">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{url('./start/public/frame/images/logo.png')}}" srcset="{{url('./start/public/frame/images/logo-retina.png 2x')}}" alt="">
                        </a>
                    </div>
                    <!--navigation-->
                    <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                    <div class="nav-holder-s"></div>
                    <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
                    <!--//navigation-->
                    <div class="col-auto minicart-holder-s"></div>
                </div>
            </div>
        </div>
    </header>
