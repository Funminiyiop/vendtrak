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

                    <?php  
                        $customerID = $customer->customer_id; 
                        $name = $customer->company;
                        $email = $customer->email;
                    ?>
                    
                    <div class="col-md-9 aside">
                        <h3>Customer Details</h3>

                        <div class="mt-3">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><b>Company Name</b>:</td>
                                            <td>{{ $customer->company }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b>:</td>
                                            <td>
                                                <?php echo $customer->h_no; ?>, <?php echo $customer->street; ?> street, 
                                                <?php echo $customer->area1; ?> <?php echo $customer->area2; ?>,  
                                                <?php echo $customer->city; ?>, <?php echo $customer->state; ?>, 
                                                <?php echo $customer->country; ?>. 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b>:</td>
                                            <td>{{ $customer->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone</b>:</td>
                                            <?php 
                                                if($customer->phone2 === '' || $customer->phone2 === NULL) { 
                                            ?>
                                                <td>{{ $customer->phone1 }}.</td>
                                            <?php  } else { ?>
                                                <td>{{ $customer->phone1 }}, {{ $customer->phone2 }}.</td>
                                            <?php 
                                                }
                                            ?>
                                            
                                        </tr>
                                        <tr>
                                            <td><b>Contact Person's Name</b>:</td>
                                            <td>
                                                <?php echo $customer->cpfname; ?> <?php echo $customer->cplname; ?> (<?php echo $customer->cptitle; ?>)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Contact Person's Email</b>:</td>
                                            <td>{{ $customer->cpemail }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Contact Person's Phone</b>:</td>
                                            <td>
                                                <?php 
                                                    if($customer->cpphone2 === '' || $customer->cpphone2 === NULL) { 
                                                ?>
                                                        {{ $customer->cpphone1 }}.
                                                <?php  } else { ?>
                                                    {{ $customer->cpphone1 }}, {{ $customer->cpphone2 }}.
                                                <?php 
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div style="margin-top: 20px;" class="row">
                                <div class="col-lg-4">
                                    <div><a class="btn" style="font-size: 16px;" href="{{ url('/editcustomer/'.$customerID) }}"><b>Edit</b></a></div>
                                </div>
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4">
                                    <div><a class="btn" style="font-size: 16px;" href="{{ url('/deletecustomer/'.$customerID) }}"><b>Delete</b></a></div>
                                </div>
                            </div>
                            
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>


     		
@endsection