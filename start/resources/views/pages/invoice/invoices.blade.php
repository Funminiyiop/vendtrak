<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Invoice</title>
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
                            <h3>Invoices</h3>
                            
                            <table class="table table-bordered table-striped table-order-history">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><b>Date</b></th>
                                        <th scope="col"><b>Invoice</b></th>
                                        <th scope="col"><b>Amount</b></th>
                                        <th scope="col"><b>Status</b></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $count = 0; foreach($invoices as $invoice){ ?>

                                    <tr>
                                        <th><?php echo $count+=1; ?></th>
                                        <td>{{$invoice->invoice_date}}</td>
                                        <td>#{{$invoice->invoice_id}}</td>
                                        <td>N{{number_format($invoice->total, 2)}}</td>
                                        <td>{{$invoice->status}}</td>
                                        <td>
                                            <form class="form-horizontal"  method="post" action="{{ url('/viewinvoice') }}" >
                                            {{ csrf_field() }} 
                                                <input  type="text" class="form-control" value={{$invoice->rep_id}} name="agent" hidden/>
                                                <input  type="text" class="form-control" value={{$invoice->invoice_id}} name="invoice" hidden/>
                                                <input  type="text" class="form-control" value={{$invoice->buyer_id}} name="customer" hidden/>
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