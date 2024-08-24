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

                    <div class="col-md-9 aside">
                        <div class="table-responsive">
                            <h3>Customers</h3>
                            
                            <div class="container text-right">
                                <a href="{{ url('/addcustomer') }}" class="btn">Add New Customer</a>
                            </div>


                            <table class="table table-bordered table-striped table-order-history">
                            
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">City</th>
                                        <th scope="col">State</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $count = 0; foreach($customers as $customer){ ?>
                                    <tr>
                                        <th><?php echo $count+=1; ?></th>
                                        <td><a href="{{ url('/viewcustomer/'.$customer->customer_id) }}" class="ml-1">{{ $customer->company }}</a></td>
                                        <td>{{ $customer->area1 }} {{ $customer->area2 }}</td>
                                        <td><span class="color">{{ $customer->city }}</span></td>
                                        <td>{{ $customer->state }}</td>
                                        <td>
                                            <a href="{{ url('/viewcustomer/'.$customer->customer_id) }}"><b>View</b></a>
                                            <a href="{{ url('/editcustomer/'.$customer->customer_id) }}"><b class="ml-1 mr-1">Edit</b></a>
                                            <a href="{{ url('/deletecustomer/'.$customer->customer_id) }}"><b>Delete</b></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


     		
@endsection