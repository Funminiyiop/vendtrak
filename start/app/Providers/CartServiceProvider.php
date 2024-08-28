<?php

namespace App\Providers;

use Auth, Session;
use App\SalesRobot\Robot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Use view composer to share cart data with all views
        View::composer('*', function () {
            // Get the cart details
            
            //$cartDetails = Cart::calculateCart(); // Replace with your cart calculation function
            
            $robot = new Robot;
            $acUser = Auth::user();
            if($acUser === null || $acUser === '') { 
                $cartDetails = [];
                $cartTotal = 0;
                $cartQty = 0;
                View::share('cartDetails', $cartDetails);
                View::share('cartTotal', $cartTotal);
                View::share('cartQty', $cartQty);
                return redirect('/login'); 
            }

            $cartTotal = 0;
            $cusID = Session::get('table.customer');
            $cartDetailss = $robot->getCartDetailsByAgentAndCustomer(Auth::user()->email, $cusID)->toArray();
            if($cartDetailss === [] || $cartDetailss === null) {
                $cartDetails = [];
                $cartTotal = 0;
                $cartQty = 0;
                $total = 0;
                $vat = 0;
            } else {
                $cartDetails = $cartDetailss;
                $cartQty = count($cartDetails);
                foreach ($cartDetails as $item) {
                    $cartTotal += $item['subtotal'];
                }
                $vat =  (4/100) * $cartTotal; // 3 percent of total
                $total = $cartTotal + $vat;
            }

            /*
            
            dd(count($cartDetails));
            exit;

            foreach ($cartDetails as $item) {
                $cartTotal += $item['subtotal'];
            }
            */

            //return view('pages.cart.cart')->withCart($cart); 
            // Share the cart details with all views
            View::share('cartDetails', $cartDetails);
            View::share('cartTotal', $cartTotal);
            View::share('cartQty', $cartQty);
            View::share('total', $total);
            View::share('vat', $vat);

        });

    }
}
