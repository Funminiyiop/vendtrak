# VENDtrak 

## VENDtrak Documentation

## Introduction

VENDtrak is an ecommerce application that aims to address majorly the challenge of sales representatives stealing away with funds from book sales due to the manual cash handling and manual invoicing process that has most times led to discrepancies and mistrust between sales representatives, the customers and the company. 

VENDtrak ensures transparency, accountability, and efficiency in book sales transactions.

## Key Features:
- Real-Time Sales Tracking: 
VENDtrak allows sales representatives to input sales data in real time, enabling accurate and up-to-date tracking and transparent reporting of all book sale transactions, ensuring that all parties have access to accurate and up-to-date information.

- Automated Invoicing: 
VENDtrak helps to automate the invoicing process based on sales data input at checkout point, reducing manual errors in sales transaction record.

- User Friendly Interface: 
The intuitive user interface makes it easy for sales representatives and administrators to navigate the platform, manage sales, and access critical information.

- Real-time Reporting: 
VENDtrak offers detailed and accurate reporting as each agent's sales performance, sales records and invoices are made available to the authors and publishers of the book product. 

- Role-Based Access Control: 
Implement robust security measures with role-based access control to ensure that sensitive data is accessible only to authorized personnel.

## Installation guide
To run VENDtrak, you must have PHP 7.4.2. and above
To run the project, create an empty database.
Then just do the following:

    git clone https://github.com/Funminiyiop/vendtrak.git
    cd vendtrak/start
	cp .env.example .env
	

In .env file type your database credentials in these lines:

    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=laravel  
    DB_USERNAME=root  
    DB_PASSWORD=

After that, run these commands from terminal:
		
    composer install
    php artisan key:generate
    php artisan migrate
	    

## Usage Guide
### To register:
- click on "My Account" at the top right of the page,
- click on "Register",
- input your details (your name, email password and confirm your password)  and 
- click the "Register" button to submit your registration.

An activation email will be sent to your email which you need to click to make your account active.

Please note: The Author or publisher have to approve your account before you can login.

### To login:
- click on "My Account" at the top right of the page,
- click on "Login",
- input your details (your email and password)  and 
- click the "Log in" button to submit your login request.


### To Update your password:
- First log into your account,
- click on "My Profile" on the left menu in your dashboard,
- fill the update password form on the right side of the profile page. Details required are current password, new password and confirm your new password, 
- click the "Update Password" button to submit your request.


### To view all sales records:
- First log into your account,
- click on "My Sales History" on the left menu in your dashboard. 
This will display the list of all your sales transactions.

#### To view the complete details of a sales record:
- click the "view" button at the right of any of the sales record you like to see.
This will take you to the single page of the sales record with the complete information about the sales transaction.


### To view all invoices:
- First log into your account,
- click on "Invoices" on the left menu in your dashboard. 
This will display the list of all the invoices for all transactions made by you.

#### To view the complete details of an invoice:
- click the "view" button at the right of any of the invoice you like to see.
This will take you to the single page of the invoice with the complete information about the invoice transaction.


### To view all customers:
- First log into your account,
- click on "My Customers" on the left menu in your dashboard. 
This will display the list of all the customers registered by you.

#### To view the complete details of a customer:
- click the "view" button at the right of any of the customer you like to see.
This will take you to the single page of the customer with the complete information about the 
customer.

#### To edit/update the details of a customer:
- click the "edit" button at the right of any of the customer you like to update.
This will take you to the edit page.
- input the correct detail you like to change and 
- click the "submit" button to send your request.

#### To delete a customer:
- click the "delete" button at the right of any of the customer you like to delete.
- click on the "submit" button in the confirmation notification to confirm and send your delete request.


### To view all books:
- First log into your account,
- click on "Books" on the left menu in your dashboard. 
This will display the list of all the books the are available for sales.

#### To view the complete details of a book:
- click the "view" button at the right of any of the books you like to see.
This will take you to the single page of the book with the complete information about the 
book with "add to cart" button.


### Add a book to cart:
- First log into your account,
- click on "Books" on the left menu in your dashboard. 
This will display the list of all the books the are available for sales.
- click the "view" button at the right of any of the books you like to add to cart.
This will take you to the single page of the book with the complete information about the 
book with "add to cart" button.
- Select customer. You need to select the customer you want to order for. At the right side of the "Add to Cart" section, select a customer from the drop down list of all your registered customers and click on "Select Customer" button.
- On the left side of the "Add to Cart" section, select the quantity and click on "add to cart" button.


### View cart and Checkout:
- click on "Shopping Cart" just below the "My Account" button at the top right of the page.
This will display the list of items you have in your cart.
- change the quantity and click on the button with "pencil" icon to edit the quantity of an item in your cart.
- click on the button with "x" icon to remove an item in your cart.
- click the "checkout" button to preoceed to checkout if satisfied with the order.
This will redirect you to the checkout page with the summary of your order. 
- click "place order" button to place your order after you have confirmed and satisfied with the details of your order 


## project architecture

```bash
├── Index                 
│
│
├── Register                        
│   
│
├── Login                           
│   
│
│   
├── Dashboard
│   │                         
│   ├── Profile                             # has update password form to update password               
│   │ 
│   │ 
|   ├── Customers                           # To view all customers                  
│   │    ├── View Customer                  # To view single customer details       
│   │    ├── Edit Customer                  # TO edit single customer details
│   │    └── Delete Customer                # To delete single customer details
│   │  
│   │ 
|   ├── Books                               # To view all books available for sales            
│   │    ├── View Books                     # To view single book details
│   │    ├── Edit Books                     # To edit single book details
│   │    └── Delete Books                   # To delete single book details
│   │       
│   │
│   ├── Sales History                       # To view all sales records
│   │    └──  View sales Record             # To view single sales record
│   │   
│   │
│   └── Sales Invoices                      # To view all sales invoices
│        └──  View sales Invoices           # To view single sales invoice                   
│  
│  
├── About                        
│  
│  
├── Books                          
│  
│ 
├── Contact                        
│   
│  
└── Cart                        
```


