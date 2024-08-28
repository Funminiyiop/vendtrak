<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Dashboard</title>
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

                    <div class="col-md-9 aside">
                        <h3>Dashboard (Sales Rep)</h3>
                                
                        <div class="prd-grid data-to-show-4 data-to-show-md-2 data-to-show-sm-2 data-to-show-xs-2 js-product-isotope prd-text-center prd-grid--sm-pad">
                            
                            <div class="prd prd-has-loader prd prd-new prd-featured">
                                <a href="{{ url('/books') }}">
                                    <div class="prd-inside pt-5 pb-8">
                                        <div class="prd-info">
                                            <div class="prd-tag prd-hidemobile"><b>All</b></div>
                                            <h1 class="prd-title"><b>Book Products</b>
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="prd prd-has-loader prd prd-new prd-featured">
                                <a href="{{ url('/sales') }}">
                                    <div class="prd-inside pt-5 pb-8">
                                        <div class="prd-info">
                                            <div class="prd-tag prd-hidemobile"><b>My</b></div>
                                            <h1 class="prd-title"><b>Sales History</b>
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="prd prd-has-loader prd prd-new prd-featured">
                                <a href="{{ url('/invoices') }}">
                                    <div class="prd-inside pt-5 pb-8">
                                        <div class="prd-info">
                                            <div class="prd-tag prd-hidemobile"><b>My</b></div>
                                            <h1 class="prd-title"><b>Sales Invoices</b>
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="prd prd-has-loader prd prd-new prd-featured">
                                <a href="{{ url('/customers') }}">
                                    <div class="prd-inside pt-5 pb-8">
                                        <div class="prd-info">
                                            <div class="prd-tag prd-hidemobile"><b>My</b></div>
                                            <h1 class="prd-title"><b>Customers</b>
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            

                        </div>

                    </div>
                </div>
            </div>
        </div>


     		
@endsection