<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Verify Email Page</title>
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
        
        
        @if (session('status') == 'verification-link-sent')
        <div class="holder mt-20">
            <div class="container">
                <div style="color: #000; font-size: 16px;" class="text-center">
                    <span>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
                </div>
            </div>
        </div>
        @endif

        


        <div class="holder mt-30">
            <div class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-sm-8 col-md-6">
                        <div id="loginForm">
                            <h2 class="text-center">VERIFY EMAIL</h2>
                            <div>
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>
                            <div class="form-wrapper">
                                

                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="text-center">
                                        <button type="submit" class="btn">{{ __('Resend Verification Email') }}</button>
                                    </div>
                                </form>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="text-center">
                                        <button type="submit" class="btn">{{ __('Log Out') }}</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        
                        
                    </div>

                </div>
            </div>
        </div>




     		
@endsection