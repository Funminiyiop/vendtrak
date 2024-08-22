<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Register Page</title>
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
                <div class="row justify-content-center">
                    
                    <div class="col-sm-8 col-md-6">
                        <div id="loginForm">
                            <h2 class="text-center">REGISTER</h2>
                            <div class="form-wrapper">
                                
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        required autofocus autocomplete="name" placeholder="Your Name" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        required autofocus autocomplete="username" placeholder="Your Email" />
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password" name="password" class="form-control" 
                                        required autocomplete="new-password" placeholder="Password" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" 
                                        required autocomplete="new-password" placeholder="Confirm Password" />
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn">{{ __('Register') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        
                        
                    </div>

                </div>
            </div>
        </div>




     		
@endsection