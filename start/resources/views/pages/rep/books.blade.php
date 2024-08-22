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

                    <div class="col-md-9 aside">
                        <div class="table-responsive">
                            <h3>Books</h3>
                            
                            <table class="table table-bordered table-striped table-order-history">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        $count = 0; 
                                        foreach($books as $bbook){
                                        //$bookID = $bbook->book_id; 
                                        //$enp = number_format($bbook->price, 2);
                                        //$title = $bbook->title;
                                    ?>

                                    <tr>
                                        <th><?php echo $count+=1; ?></th>
                                        <td><a href="{{ url('/viewbook/'.$bbook->book_id) }}" class="ml-1">{{ $bbook->title }}</a></td>
                                        <td>{{ $bbook->author }}</td>
                                        <td><span class="color">N{{ number_format($bbook->price, 2) }}</span></td>
                                        <td>{{ $bbook->availableQty }}</td>
                                        <td>
                                            <a href="{{ url('/viewbook/'.$bbook->book_id) }}"><b>View</b></a>
                                        </td>
                                    </tr>

                                    <?php 
                                        }
                                    ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


     		
@endsection