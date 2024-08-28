<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>VENDtrak Book Sales Solutions | Dashboard</title>
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

        @if (session('status') === 'password-updated')
        <div class="holder mt-20">
            <div class="container">
                <div style="color: #000; font-size: 16px;" class="text-center">
                    <span>{{ __('Success: Password updated.') }}</span>
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
                        <h2>Account Details</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Personal Info</h3>
                                        <p>
                                            <b>Names:</b> {{ Auth::user()->name }}<br>
                                            <b>E-mail:</b> {{ Auth::user()->email }}
                                        </p>
                                        <div class="mt-2 clearfix"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2 mt-sm-0">
                                <div class="card">        
                                    <div class="card-body">
                                        <h3>Update Password</h3>

                                        <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('put')

                                            <div class="form-group">
                                                <input name="current_password" type="password" autocomplete="current-password"  
                                                class="form-control" placeholder="Current Password">
                                            </div>
                                            <div class="form-group">
                                                <input name="password" type="password" autocomplete="new-password" 
                                                class="form-control" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <input name="password_confirmation" type="password" autocomplete="new-password"  
                                                class="form-control" placeholder="Confirm Password">
                                            </div>
                                            <button type="submit" class="btn">Update Password</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


     		
@endsection