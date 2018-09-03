<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>
Sample Merchant SA PHP
<link href="https://365.vtc.vn/trading/Content/css/365.css" rel="stylesheet">
<link href="https://365.vtc.vn/trading/Content/css/style.css" rel="stylesheet">
</title
</head>
<body>
	 <form class="form" name="form" method="post" action="checkout_version2.php" id="form2" style="float:right;margin-top:-30%;">
	  <table>
	    <tr><td></td><td>Version 2</td></tr>
        <tr><td>OrderID</td><td>
         <input name="txtOrderID" type="text" value="<?php echo date("YmdHis")?>" id="txtOrderID" /></td></tr>
		  <tr>
		<td>Customer First Name</td><td>
        <input name="txtCustomerFirstName" type="text" value="" id="txtCustomerFirstName" /></td></tr>
		<td>Customer Last Name</td><td>
        <input name="txtCustomerLastName" type="text" value="" id="txtCustomerLastName" /></td></tr>
		<td>Bill to address line 1</td><td>
        <input name="txtBillAddress" type="text" value="" id="txtBillAddress" /></td></tr>
		
		<td>City</td><td>
        <input name="txtCity" type="text" value="" id="txtCity" /></td></tr>
		<td>Email</td><td>
       
        <input name="txtCustomerEmail" type="text" value="" id="txtCustomerEmail" /></td></tr>
		<td>Customer Mobile</td><td>
        <input name="txtCustomerMobile" type="text" value="<?php echo "01657758300"?>" id="txtCustomerMobile" /></td></tr>
		<td>Param Extent</td><td>
        <input name="txtParamExt" type="text" value="" id="txtParamExt" /></td></tr>
		<td>Language</td><td>
        <input name="txtParamLanguage" type="text" value="vi" id="txtParamLanguage" /></td></tr>
		<td>URL return</td><td>
        <input name="txtUrlReturn" type="text" value="<?php echo "http://en.tourgolf.vn/done2.php"?>" id="txtUrlReturn" /></td></tr>
		<td>Secret Key</td><td>
        <input name="txtSecret" type="text" value="<?php echo "Tranquoctoan1991@gmail.com"?>" id="txtSecret" /></td></tr>
    <tr><td>Price: </td><td>
        <input name="txtTotalAmount" type="text" value="100000" id="txtTotalAmount" /></td></tr>
    <tr><td>payment_type: </td><td>
        <input name="payment_type" type="text" value="DomesticBank" id="txtTotalAmount" /></td></tr>
    
     <tr><td class="style1">Unit: </td><td class="style1">
        <input name="txtCurency" type="text" value="VND" id="txtCurency" />

        
         &nbsp;<i>VND/USD</i></td></tr>
		
        <tr><td>Website ID</td><td><input name="txtWebsiteID" type="text" value="6219" id="txtWebsiteID" /></td></tr>
    <tr><td></td><td>
        <tr><td>Recieve Account</td><td><input name="txtReceiveAccount" type="text" value="<?php echo "0965966078"?>" id="txtReceiveAccount" /></td></tr>		
<tr><td>Description</td><td>
             <input name="txtDescription" type="text" value="MUA_DIEN_THOAI" id="txtDescription" /></td></tr>					 			
    <tr><td></td><td>	
        <input type="submit" name="Button1" value="Pay with Paygate" id="Button1" style="width:188px;" />
        </td></tr>
</table>
		 </form>
</body>
</html>