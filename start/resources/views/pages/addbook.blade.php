<!DOCTYPE html>
<html lang="en">
    <head>
        <title>E-Sales System</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
    </head>
    <body>
        <h2>E-Sales System</h2>
        <div>
            
						@if (Session::has('message'))
						<div style="margin-top: 0px; margin-bottom: 60px;" class="title-sm style2">
							<p style="color: #000; font-size: 16px;">
								{{ Session::get('message') }}
							</p>
						</div>
						@endif

            <h3>Book Adding Form</h3>
            
            
                <form class="form-horizontal"  method="post" action="{{ url('/postbook') }}" >
                    {{ csrf_field() }}  
                    <div class="col-lg-12">
                        <h4 style="color: #ffQf; font-weight: 800" >Book Details</h4>
                    </div>
                    
                    <div>
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Book ID *</label>
                            <input  type="text" class="form-control" name="BookID" placeholder="No space, no symbol"/>
                        </div>
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Book Title *</label>
                            <input  type="text" class="form-control" name="BookTitle" />
                        </div>

                        
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Book Author *</label>
                            <input  type="text" class="form-control" name="BookAuthor" />                                
                        </div>
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Book Description *</label>
                            <input  type="textarea" class="form-control" name="BookDescription" />
                        </div>
                        
                        
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Genre *</label>
                            <input  type="text" class="form-control" name="BookGenre"/>
                        </div>
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Price *</label>
                            <input  type="text" class="form-control" name="BookPrice"/>
                        </div>
                        
                        <div>
                            <label style="margin-top: 10px; color: #50a8af;">Available Quantity *</label>
                            <input  type="number" class="form-control" name="BookQty"/>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <?php
                                $no1 = rand(2, 50);
                                $no2 = rand(2, 50);
                                $ans = $no1 + $no2;
                            ?>
                            <div>
                                <label for="qna">* Please answer this question: <?php echo $no1; ?> + <?php echo $no2; ?> is what? </label>
                            </div>
                            <div>
                                <input  type="text" class="form-control"  name="qna" placeholder="Enter your answer here" />
                                <input type="hidden" name="no1" value="<?php echo $no1; ?>"> 
                                <input type="hidden" name="no2" value="<?php echo $no2; ?>"> 
                            </div>
                        </div>
                    </div>
                    
                    
                    <div>
                        <div>
                            <button type="submit" class="btn btn-info">
                                <span style="font-weight: 700">Submit</span>
                            </button>
                        </div>
                    </div>
                    
                </form>   

                <h4><a href="{{ url('/books') }}">View Books</a></h4>





        </div>
    </body>
</html>