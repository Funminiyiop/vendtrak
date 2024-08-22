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
                        <h3>Add Book</h3>
                        
                        <div class="card mt-3">
                            <div class="card-body">
                            
                                <form class="form-horizontal"  method="post" action="{{ url('/postbook') }}" >
                                    {{ csrf_field() }}  

                                    <div class="container">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Book ID *</label>
                                                <input  type="text" class="form-control" name="BookID" placeholder="No space, no symbol"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Book Title *</label>
                                                <input  type="text" class="form-control" name="BookTitle"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Book Author *</label>
                                                <input  type="text" class="form-control" name="BookAuthor"/>
                                            </div>
                                        </div>

                                        <div class="row col-lg-12">
                                            <div class="col-lg-12">
                                                <label style="margin-top: 10px; ">Book Description *</label>
                                                <input  type="textarea" class="form-control" name="BookDescription"/>
                                            </div>
                                        </div>

                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Genre *</label>
                                                <input  type="text" class="form-control" name="BookGenre"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Price *</label>
                                                <input  type="text" class="form-control" name="BookPrice"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Available Quantity *</label>
                                                <input  type="number" class="form-control" name="BookQty"/>
                                            </div>
                                        </div>
                                        
                                        <div class="row col-lg-12">
                                            <?php
                                                $no1 = rand(2, 50);
                                                $no2 = rand(2, 50);
                                                $ans = $no1 + $no2;
                                            ?>
                                            <div style="margin-top: 10px; margin-left: 15px;" class="col-lg-6">
                                                <label for="qna"><?php echo $no1; ?> + <?php echo $no2; ?> *</label>
                                            </div>
                                            <div style="margin-top: 10px;" class="col-lg-5">
                                                <input  type="text" class="form-control"  name="qna" placeholder="Enter your answer here" />
                                                <input type="hidden" name="no1" value="<?php echo $no1; ?>"> 
                                                <input type="hidden" name="no2" value="<?php echo $no2; ?>"> 
                                            </div>
                                            <div>
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-info">
                                                        <span style="font-weight: 700">Submit</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


     		
@endsection