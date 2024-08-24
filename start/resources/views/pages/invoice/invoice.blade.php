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
                            <h3>Invoice</h3>
                            
                            
                            <div class="card">
                                <div class="card-body p-50">
                                    <div class="invoice">
                                        <div class="d-md-flex justify-content-between align-items-center">
                                            <h2 class="font-weight-800 d-flex align-items-center">
                                                <!-- img class="m-r-20" src="" alt="image" -->LOGO
                                            </h2>
                                            <h3 class="text-xs-left m-b-0">Invoice #{{$invoice['invoice']}}</h3>
                                        </div>
                                        <hr class="m-t-b-50">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>
                                                    <b>Invoice From:</b>
                                                </p>
                                                <p><b>VENDtrak</b> <br> 1, Popoola Street,<br>Bodija, Ibadan, Nigeria.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-right">
                                                    <b>Invoice to:</b>
                                                </p>
                                                <p class="text-right"><b>{{$invoice['customer_name']}}</b> <br> {{$invoice['customer_address']}},<br> {{$invoice['customer_city']}}.</p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table m-t-b-50">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Description</b></th>
                                                    <th class="text-right"><b>Quantity</b></th>
                                                    <th class="text-right"><b>Unit cost</b></th>
                                                    <th class="text-right"><b>Total</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $count = 0; foreach($invoice['items'] as $item){ ?>

                                                    <tr class="text-right">
                                                        <td class="text-left"><?php echo $count+=1; ?></td>
                                                        <td class="text-left">{{ $item['title'] }}</td>
                                                        <td>{{ $item['qty'] }}</td>
                                                        <td>N{{ number_format($item['price'], 2) }}</td>
                                                        <td>N{{ number_format($item['subtotal'], 2) }}</td>
                                                    </tr>

                                                <?php } ?>
                                                <div>
                                                    
                                                    <tr>
                                                        <th><b></b></th>
                                                        <th><b></b></th>
                                                        <th class="text-right"><b></b></th>
                                                        <th class="text-right"><b>Sub - Total:</b></th>
                                                        <th class="text-right"><b>N{{ number_format($invoice['subtotal'], 2) }}</b></th>
                                                    </tr>
                                                    <tr>
                                                        <th><b></b></th>
                                                        <th><b></b></th>
                                                        <th class="text-right"><b></b></th>
                                                        <th class="text-right"><b>vat (4%): </b></th>
                                                        <th class="text-right"><b>N{{ number_format($invoice['vat'], 2) }}</b></th>
                                                    </tr>
                                                    <tr>
                                                        <th><b></b></th>
                                                        <th><b></b></th>
                                                        <th class="text-right"><b></b></th>
                                                        <th class="text-right"><b>Total:</b></th>
                                                        <th class="text-right"><b>N{{ number_format($invoice['total'], 2) }}</b></th>
                                                    </tr>
                                                </div>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <hr class="m-t-b-50">
                                        <p class="text-center small text-muted  m-t-50">
                                            <span class="row">
                                                <span class="col-md-6 offset-3">
                                                    Please Note: Do not pay to any Sales representative
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


     		
@endsection