<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Books</title>
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
                        $bookID = $book->book_id; 
                        $price = $book->price;
                        $enp = number_format($price, 2);
                        $qty = $book->availableQty;
                        $title = $book->title;
                        $description = $book->description;
                        $salesAgent = Auth::user()->email;
                    ?>
                    
                    <div class="col-md-9 aside">
                        <div class="row">
                            
                            <div class="col-md-6 mt-2 mt-md-0">
                                <div class="card card--grey">
                                    <div class="card-body">
                                        <h2>Add to Cart</h2>
                                        
                                        <form class="form-horizontal"  method="post" action="{{ url('/addcart') }}" >
                                            {{ csrf_field() }} 
                                            <label class="text-uppercase">Quantity</label>
                                            <div class="form-group">
                                                <input  type="number" min="0" class="form-control" name="bookQty"/>
                                            </div>
                                            <div class="row">
                                                <input  type="text" class="form-control" value={{$bookID}} name="bookID" hidden/>
                                                <input  type="text" class="form-control" value={{$price}} name="bookPrice" hidden/>
                                                <input  type="text" class="form-control" value={{Session::get('table.customer')}} name="customer" hidden/>
                                                <input  type="text" class="form-control" value={{$salesAgent}} name="salesAgent" hidden/>
                                                
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-info col-md-12 col-lg-12">
                                                        <span style="font-weight: 700">Add to Cart</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="mt-2"></div>
                            </div>
                            
                            <div class="col-md-6 mt-2 mt-md-0">
                                <div class="card card--grey">
                                    <div class="card-body">
                                        <h5>Selected Customer: 
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
                                        <h5>
                                        
                                        <form class="form-horizontal"  method="post" action="{{ url('/selectcustomer') }}" >
                                            {{ csrf_field() }} 
                                            <label class="text-uppercase">Customer</label>
                                            <div class="form-group select-wrapper">
                                                <select name="customer" class="form-control">
                                                    <?php foreach ($cagent as $cus) { ?>
                                                        <option value="{{ $cus->customer_id }}" > {{ $cus->company }} </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <input  type="text" class="form-control" value={{$salesAgent}} name="salesAgent" hidden/>

                                                
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-info col-md-12 col-lg-12">                                
                                                        
                                                        <?php if($sc === '' || $sc === NULL) { ?>
                                                            <span style="font-weight: 700">Select Customer</span>
                                                        <?php  } else { ?>
                                                            <span style="font-weight: 700">Change Customer</span>
                                                        <?php } ?>

                                                    </button>
                                                </div>



                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="mt-2"></div>
                            </div>
                            
                        </div>

                        <div class="table-responsive">
                            <h3>Book Details</h3>

                            
                            <div class="mt-3">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><b>Price</b>:</td>
                                                <td>N{{ number_format($price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Title</b>:</td>
                                                <td>{{ $book->title }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Author</b>:</td>
                                                <td>{{ $book->author }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Genre</b>:</td>
                                                <td>{{ $book->genre }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Quantity Available</b>:</td>
                                                <td>{{ $book->availableQty }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h3>Description:</h3>
                                <p>{{ $book->description }}</p>
                                
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


     		
@endsection