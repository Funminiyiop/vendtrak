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
--> click on "My Account",
--> click "Register"
Input your details and click the "Register" button.

An activation email will be sent to your email which you need to click to make your account active.

Please note: The Author or publisher have to approve your account before you can login.


## project architecture



