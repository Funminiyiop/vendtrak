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
        
        <div></div>

        <div>

            {{ Auth::user()->name }} - {{ __('Master: Books') }}

						@if (Session::has('message'))
						<div style="margin-top: 0px; margin-bottom: 60px;" class="title-sm style2">
							<p style="color: #000; font-size: 16px;">
								{{ Session::get('message') }}
							</p>
						</div>
						@endif

            <h3>Book List</h3>
            <table>
                <tr>
                    <h4><a href="{{ url('/addbook') }}">Add New Book</a></h4>
                </tr>
                <tr>
                    <th>BookID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Av. Qty</th>
                    <th>Order Now</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php 
                    foreach($books as $bbook){
                    $bookID = $bbook->book_id; 
                    $enp = number_format($bbook->price, 2);
                    $title = $bbook->title;
                ?>

                <tr>
                    <td>{{ $bookID }}</td>
                    <td><a href="{{ url('/viewbook/'.$bookID) }}">{{ $title }}</a></td>
                    <td>N{{ $enp }}</td>
                    <td>{{ $bbook->availableQty }}</td>
                    <td><a style="font-size: 15px;" href="{{ url('/order/'.$bookID) }}">Order Now</a></td>
                    <td><a style="font-size: 15px;" href="{{ url('/viewbook/'.$bookID) }}">View</a></td>
                    <td><a style="font-size: 15px;" href="{{ url('/editbook/'.$bookID) }}">Edit</a></td>
                    <td><a style="font-size: 15px;" href="{{ url('/deletebook/'.$bookID) }}">Delete</a></td>
                </tr>
                
                <?php 
                    }
                ?>

            </table>

        </div>
    </body>
</html>