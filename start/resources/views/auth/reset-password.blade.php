<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Reset Password Page</title>
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
                            <h2 class="text-center">RESET PASSWORD</h2>
                            <div class="form-wrapper">
                                
                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf
                                    
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    
                                    <div class="form-group">
                                        <input id="email" type="email" name="email" value="{{ $request->email }}" class="form-control"
                                        required autofocus/>
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
                                        <button type="submit" class="btn">{{ __('Reset Password') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        
                        
                    </div>

                </div>
            </div>
        </div>




     		
@endsection