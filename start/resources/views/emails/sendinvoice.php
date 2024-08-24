<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div>
    
    	
    	<p>Hello, <br /><br />
    	
            Thank you for your patronage, your order was successfully processed.<br /><br />
            
            See information of your invoice as below:<br />
            

            <strong>Invoice No:</strong> #<?php echo $invoiceData['invoice']; ?> <br />
            <strong>Invoice Status:</strong> <?php echo $invoiceData['status']; ?> <br />

            <strong>Customer Name:</strong> <?php echo $invoiceData['customer_name']; ?> <br />
            <strong>Customer Address:</strong> <?php echo $invoiceData['customer_address']; ?> <br />
            <strong>Customer Email:</strong> <?php echo $invoiceData['customer_email']; ?> <br />
            <strong>Customer Phone:</strong> <?php echo $invoiceData['customer_phone']; ?>  <br />
            
            <strong> ---- Items: --- </strong> 
            
            <?php $count = 0; foreach($invoiceData['items'] as $item){ ?>

            <tr>
                <th><?php echo $count+=1; ?></th>
                <td><?php echo $item->title; ?></td>
                <td><?php echo $item->qty; ?>{{ $item->qty }}</td>
                <td>N<?php echo number_format($item->price, 2); ?></td>
                <td>N<?php echo number_format($item->subtotal, 2); ?></td>
            </tr>

            <?php } ?>

            
            <strong>Sub-Total :</strong> <?php echo $invoiceData['subtotal']; ?> <br />
            <strong>VAT 4%:</strong> <?php echo $invoiceData['vat']; ?> <br />
            <strong>Total:</strong> <?php echo $invoiceData['total']; ?> <br />

            <strong>Date:</strong> <?php echo $invoiceData['date']; ?> <br /><br />
            
    	</p>
    </div>
</body>
</html>