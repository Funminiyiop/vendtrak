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
                            <h3>Sales Record</h3>
                            
                            
                            <div class="card">
                                <div class="card-body p-50">
                                    <div class="invoice">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-left">
                                                    <b>{{$detailed['customer_name']}}</b> <br> 
                                                    {{$detailed['customer_address']}},<br> 
                                                    {{$detailed['customer_city']}}. <br>
                                                    {{$detailed['customer_phone']}} <br>
                                                    {{$detailed['customer_email']}} <br>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-right">
                                                    <b>Contact Person Details: </b><br>
                                                    {{$detailed['customer_contact_person']}} <br>
                                                    {{$detailed['customer_contact_person_email']}} <br>
                                                    {{$detailed['customer_contact_person_phone']}}

                                                </p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table m-t-b-50">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Item(s)</b></th>
                                                    <th class="text-right"><b>Quantity</b></th>
                                                    <th class="text-right"><b>Unit cost</b></th>
                                                    <th class="text-right"><b>Total</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $count = 0; foreach($detailed['items'] as $item){ ?>

                                                    <tr class="text-right">
                                                        <td class="text-left"><?php echo $count+=1; ?></td>
                                                        <td class="text-left">{{ $item['title'] }}</td>
                                                        <td>{{ $item['qty'] }}</td>
                                                        <td>N{{ number_format($item['price'], 2) }}</td>
                                                        <td>N{{ number_format($item['subtotal'], 2) }}</td>
                                                    </tr>

                                                <?php } ?>
                                                </tbody>
                                        
                                                <hr class="m-t-b-50">
                                                <tbody>
                                                    <tr>
                                                        <td><b></b></td>
                                                        <td><b>Invoice No.:</b>  #{{$detailed['invoice']}} </td>
                                                        <td class="text-right"><b></b></td>
                                                        <td class="text-right"><b>Sub - Total:</b></td>
                                                        <td class="text-right"><b>N{{ number_format($detailed['subtotal'], 2) }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b></b></td>
                                                        <td><b>Payment Status:</b>  {{$detailed['payment_status']}}</td>
                                                        <td class="text-right"><b></b></td>
                                                        <td class="text-right"><b>vat (4%): </b></td>
                                                        <td class="text-right"><b>N{{ number_format($detailed['vat'], 2) }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b></b></td>
                                                        <td><b>Shipment Status:</b>  {{$detailed['shipment_status']}}</td>
                                                        <td class="text-right"><b></b></td>
                                                        <td class="text-right"><b>Total:</b></td>
                                                        <td class="text-right"><b>N{{ number_format($detailed['total'], 2) }}</b></td>
                                                    </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>




                    </div>
                </div>
            </div>
        </div>


     		
@endsection