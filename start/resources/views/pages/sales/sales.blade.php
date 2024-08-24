<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Sales</title>
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
                            <div class="col-md-12 row">
                                <div class="col-md-6"><h3>Invoices</h3></div>
                                <div class="col-md-6">
                                    <div class="col-md-12 row">
                                        <div class="col-md-6">
                                            <span class="text-left"><b>Total Sales Amount:</b></span>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-right"> N{{number_format($salesamt, 2)}}</h4>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <table class="table table-bordered table-striped table-order-history">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><b>Date</b></th>
                                        <th scope="col"><b>Customer</b></th>
                                        <th scope="col"><b>Invoice No.</b></th>
                                        <th scope="col"><b>Amount</b></th>
                                        <th scope="col"><b>Status</b></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $count = 0; foreach($allsales as $sales){ ?>

                                    <tr>
                                        <th><?php echo $count+=1; ?></th>
                                        <th>{{$sales->sales_date}}</th>
                                        <th>{{$sales->company}}</th>
                                        <th>#{{$sales->invoice_id}}</th>
                                        <th>N{{number_format($sales->total, 2)}}</th>
                                        <th>{{$sales->status}}</th>
                                        <td>
                                            <form class="form-horizontal"  method="post" action="{{ url('/viewsales') }}" >
                                            {{ csrf_field() }} 
                                                <input  type="text" class="form-control" value={{$sales->rep_id}} name="agent" hidden/>
                                                <input  type="text" class="form-control" value={{$sales->invoice_id}} name="invoice" hidden/>
                                                <input  type="text" class="form-control" value={{$sales->buyer_id}} name="customer" hidden/>
                                                <button type="submit" class="btn">view</button> 
                                            </form>
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