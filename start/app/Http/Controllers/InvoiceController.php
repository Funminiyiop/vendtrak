<?php

namespace App\Http\Controllers;

use Auth, Session;
use App\Models\Invoice;
use App\SalesRobot\Robot;
use App\SalesRobot\FormMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


//use App\Models\Book;
//use App\Models\Cart;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function invoices()
    {
        $robot = new Robot;
        $au = Auth::user()->toArray()['email'];
        $userAccess = $robot->getAccessLevel(); 
        if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }
        
        $invoices = $robot->getInvoicesByAgent($au)->toArray();         
        $invtotal = 0;
        foreach ($invoices as $invoice) {
            $invtotal += $invoice->total;
        }
        return view('pages.invoice.invoices')->withInvoices($invoices)->withInvtotal($invtotal);
    }

    public function viewInvoice(Request $request)
    {
        $robot = new Robot;
        $au = Auth::user()->toArray()['email'];
        $userAccess = $robot->getAccessLevel(); 
        if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }
        
        $invoice = $robot->getDetailedInvoicesByAgentCustomer($request->invoice, $request->agent, $request->customer);
        return view('pages.invoice.invoice')->withInvoice($invoice);
    }

    public function sales()
    {
        $robot = new Robot;
        $au = Auth::user()->toArray()['email'];
        $userAccess = $robot->getAccessLevel(); 
        if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }

        $allsales = $robot->getAllSalesDetailsByAgentID($au);    
        $salesamt = 0;
        foreach ($allsales as $salestotal) {
            $salesamt += $salestotal->total;
        }    
        return view('pages.sales.sales')->withAllsales($allsales)->withSalesamt($salesamt);
    }


    public function viewSales()
    {
        $robot = new Robot;
        $au = Auth::user()->toArray()['email'];
        $userAccess = $robot->getAccessLevel(); 
        if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }
        
        //$sales = $robot->getAllSalesByAgentID($au); 
        $detailedSalesData = $robot->getAllSalesDetailsByAgentID($au); 
        dd($detailedSalesData);
        exit;

        
        /*

        //count($sales);
        for($i = 0; $i < count($sales); $i++) {
            foreach ($sales as $salesrecord) {     // -agent -invoice -customer
                
                $customer = $sales[$i]->buyer_id;
                $agent = $sales[$i]->rep_id;
                $invoice = $sales[$i]->invoice_id;
                $custDetails = $robot->getCustomerDetailsByCustomerID($customer)[0];  
                $invoiceDetails = $robot->getInvoicesByAgentInvoice($agent, $invoice)->toArray()[0]; 
                $getItemOrdered = $robot->getSalesItemByInvoiceID($invoice, $agent, $customer)[0]; 
                $itemOrdered = json_decode($getItemOrdered->items, true);  
                
                $salesdata = [	
                    'date' => $getItemOrdered->sales_date,
                    'customer_name' => $custDetails->company,
                    'items' => $itemOrdered,
                    'amount' => $invoiceDetails->total,
                    'status' => $getItemOrdered->status, 
                ];
            }
                echo json_encode($salesdata);
                exit;
        }

        */

        //dd($allsales);
        
        return view('pages.sales.sales')->withAllsales($allsales);
    }











    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
