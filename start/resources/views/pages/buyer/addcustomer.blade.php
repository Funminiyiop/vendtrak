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
                        <h3>Add Customer</h3>
                        
                        <div class="card mt-3">
                            <div class="card-body">


                            
                                <form class="form-horizontal"  method="post" action="{{ url('/postcustomer') }}" >
                                    {{ csrf_field() }}  

                                    <div class="container">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-6">
                                                <label style="margin-top: 10px; ">Customer Company Name *</label>
                                                <input  type="text" class="form-control" name="company"/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-top: 10px; ">House Number *</label>
                                                <input  type="text" class="form-control" name="h_no"/>
                                            </div>
                                        </div>


                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Street Name *</label>
                                                <input  type="text" class="form-control" name="street"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Area 1*</label>
                                                <input  type="text" class="form-control" name="area1"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Area 2</label>
                                                <input  type="text" class="form-control" name="area2"/>
                                            </div>
                                        </div>

                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">City *</label>
                                                <input  type="text" class="form-control" name="city"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">State *</label>
                                                <input  type="text" class="form-control" name="state"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Country *</label>
                                                <select name="country" class="form-control">
                                                    <option value="">Choose</option>
                                                    <option>Albania</option>
                                                    <option>Algeria</option>
                                                    <option>Andorra</option>
                                                    <option>Angola</option>
                                                    <option>Antigua and Barbuda</option>
                                                    <option>Argentina</option>
                                                    <option>Armenia</option>
                                                    <option>Aruba</option>
                                                    <option>Australia</option>
                                                    <option>Austria</option>
                                                    <option>Azerbaijan</option>
                                                    <option>Bahamas</option>
                                                    <option>Bahrain</option>
                                                    <option>Bangladesh</option>
                                                    <option>Barbados</option>
                                                    <option>Belgium</option>
                                                    <option>Belize</option>
                                                    <option>Benin</option>
                                                    <option>Bermuda</option>
                                                    <option>Bhutan</option>
                                                    <option>Bolivia</option>
                                                    <option>Bosnia and Herzegovina</option>
                                                    <option>Botswana</option>
                                                    <option>Brazil</option>
                                                    <option>Brunei Darussalam</option>
                                                    <option>Bulgaria</option>
                                                    <option>Burkina Faso</option>
                                                    <option>Burma</option>
                                                    <option>Burundi</option>
                                                    <option>Cambodia</option>
                                                    <option>Cameroon</option>
                                                    <option>Canada</option>
                                                    <option>Cape Verde Islands</option>
                                                    <option>Cayman Islands</option>
                                                    <option>Central African Republic</option>
                                                    <option>Chad</option>
                                                    <option>Chile</option>
                                                    <option>China</option>
                                                    <option>Colombia</option>
                                                    <option>Comoros</option>
                                                    <option>Congo</option>
                                                    <option>Cook Islands</option>
                                                    <option>Costa Rica</option>
                                                    <option>Cote d Ivoire</option>
                                                    <option>Croatia</option>
                                                    <option>Cuba</option>
                                                    <option>Cyprus</option>
                                                    <option>Czech Republic</option>
                                                    <option>Denmark</option>
                                                    <option>Djibouti</option>
                                                    <option>Dominica</option>
                                                    <option>Dominicana</option>
                                                    <option>Ecuador</option>
                                                    <option>Egypt</option>
                                                    <option>El Salvador</option>
                                                    <option>Equatorial Guinea</option>
                                                    <option>Eritrea</option>
                                                    <option>Estonia</option>
                                                    <option>Ethiopia</option>
                                                    <option>Faroe Islands</option>
                                                    <option>Fiji</option>
                                                    <option>Finland</option>
                                                    <option>France</option>
                                                    <option>Gabon</option>
                                                    <option>Gambia</option>
                                                    <option>Georgia</option>
                                                    <option>Germany</option>
                                                    <option>Ghana</option>
                                                    <option>Gibraltar</option>
                                                    <option>Greece</option>
                                                    <option>Grenada</option>
                                                    <option>Guatemala</option>
                                                    <option>Guinea</option>
                                                    <option>Guinea-Bissau</option>
                                                    <option>Guyana</option>
                                                    <option>Haiti</option>
                                                    <option>Honduras</option>
                                                    <option>Hong Kong</option>
                                                    <option>Hungary</option>
                                                    <option>Iceland</option>
                                                    <option>India</option>
                                                    <option>Indonesia</option>
                                                    <option>Iran</option>
                                                    <option>Iraq</option>
                                                    <option>Ireland</option>
                                                    <option>Isle of Man</option>
                                                    <option>Israel</option>
                                                    <option>Italy</option>
                                                    <option>Jamaica</option>
                                                    <option>Japan</option>
                                                    <option>Jordan</option>
                                                    <option>Kazakhstan</option>
                                                    <option>Kenya</option>
                                                    <option>Kiribati</option>
                                                    <option>Korea South</option>
                                                    <option>Korea, North</option>
                                                    <option>Kuwait</option>
                                                    <option>Kyrgyzstan</option>
                                                    <option>Latvia</option>
                                                    <option>Lebanon</option>
                                                    <option>Liberia</option>
                                                    <option>Libya</option>
                                                    <option>Liechtenstein</option>
                                                    <option>Lithuania</option>
                                                    <option>Luxembourg</option>
                                                    <option>Macau</option>
                                                    <option>Macedonia</option>
                                                    <option>Madagascar</option>
                                                    <option>Malawi</option>
                                                    <option>Malaysia</option>
                                                    <option>Maldives</option>
                                                    <option>Mali</option>
                                                    <option>Malta</option>
                                                    <option>Marshall Islands</option>
                                                    <option>Mauritania</option>
                                                    <option>Mauritius</option>
                                                    <option>Mexico</option>
                                                    <option>Micronesia</option>
                                                    <option>Moldova</option>
                                                    <option>Monaco</option>
                                                    <option>Mongolia</option>
                                                    <option>Montenegro</option>
                                                    <option>Morocco</option>
                                                    <option>Mozambique</option>
                                                    <option>Myanmar</option>
                                                    <option>Namibia</option>
                                                    <option>Nauru</option>
                                                    <option>Nepal</option>
                                                    <option>Netherlands</option>
                                                    <option>Netherlands Antilles</option>
                                                    <option>New Zealand</option>
                                                    <option>Nicaragua</option>
                                                    <option>Niger</option>
                                                    <option> Nigeria </option>
                                                    <option>Norway</option>
                                                    <option>Oman</option>
                                                    <option>Pakistan</option>
                                                    <option>Panama</option>
                                                    <option>Papua New Guinea</option>
                                                    <option>Paraguay</option>
                                                    <option>Peru</option>
                                                    <option>Philippines</option>
                                                    <option>Poland</option>
                                                    <option>Portugal</option>
                                                    <option>Qatar</option>
                                                    <option>Romania</option>
                                                    <option>Russia</option>
                                                    <option>Rwanda</option>
                                                    <option>Saint Kitts and Nevis</option>
                                                    <option>Saint Lucia</option>
                                                    <option>Saint Vincent and the Grenadines</option>
                                                    <option>Samoa</option>
                                                    <option>San Marino</option>
                                                    <option>Sao Tome and Principe</option>
                                                    <option>Saudi Arabia</option>
                                                    <option>Senegal</option>
                                                    <option>Serbia</option>
                                                    <option>Serbia</option>
                                                    <option>Seychelles</option>
                                                    <option>Sierra Leone</option>
                                                    <option>Singapore</option>
                                                    <option>Slovakia</option>
                                                    <option>Slovenia</option>
                                                    <option>Solomon Islands</option>
                                                    <option>South Africa</option>
                                                    <option>Spain</option>
                                                    <option>Sri Lanka</option>
                                                    <option>St. Vincent, the Grenadines</option>
                                                    <option>Suriname</option>
                                                    <option>Swaziland</option>
                                                    <option>Sweden</option>
                                                    <option>Switzerland</option>
                                                    <option>Syria</option>
                                                    <option>Taiwan</option>
                                                    <option>Tajikistan</option>
                                                    <option>Tanzania</option>
                                                    <option>Thailand</option>
                                                    <option>Timor-Leste</option>
                                                    <option>Togo</option>
                                                    <option>Tonga</option>
                                                    <option>Trinidad and Tobago</option>
                                                    <option>Tunisia</option>
                                                    <option>Turkey</option>
                                                    <option>Turkmenistan</option>
                                                    <option>Tuvalu</option>
                                                    <option>Uganda</option>
                                                    <option>Ukraine</option>
                                                    <option>United Arab Emirates</option>
                                                    <option>United Kingdom</option>
                                                    <option>United States</option>
                                                    <option>Uruguay</option>
                                                    <option>Uzbekistan</option>
                                                    <option>Vanuatu</option>
                                                    <option>Venezuela</option>
                                                    <option>Vietnam</option>
                                                    <option>Yemen</option>
                                                    <option>Zambia</option>
                                                    <option>Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Contact Email *</label>
                                                <input  type="email" class="form-control" name="email"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Contact Phone 1 *</label>
                                                <input  type="text" class="form-control" name="phone1" placeholder="11 Digits Only"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Contact Phone 2</label>
                                                <input  type="text" class="form-control" name="phone2" placeholder="Optional"/>
                                            </div>
                                        </div>

                                        
                                        <div style="margin-top: 50px;" align="center" class="col-lg-12">
                                            <h4 style="color: #ffQf; font-weight: 400" ><b>Contact Person</b></h4>
                                        </div>
                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Title</label>
                                                <select name="cptitle" class="form-control">
                                                    <option>Ms</option>
                                                    <option>Miss</option>
                                                    <option>Mr</option>
                                                    <option>Mrs</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">First Name *</label>
                                                <input  type="text" class="form-control" name="cpfname"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Last Name *</label>
                                                <input  type="text" class="form-control" name="cplname"/>
                                            </div>
                                        </div>

                                        <div class="row col-lg-12">
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Contact Email *</label>
                                                <input  type="email" class="form-control" name="cpemail"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Contact Phone 1 *</label>
                                                <input  type="text" class="form-control" name="cpphone1" placeholder="11 Digits Only"/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-top: 10px; ">Contact Phone 2</label>
                                                <input  type="text" class="form-control" name="cpphone2" placeholder="Optional"/>
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