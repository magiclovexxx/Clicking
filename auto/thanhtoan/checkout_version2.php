<?php

    if ($_POST) {
		$destinationUrl="https://vtcpay.vn/bank-gateway/checkout.html";
  
		$plaintext =$_POST["txtTotalAmount"]."|".$_POST["txtCurency"]."|".$_POST["txtParamExt"]."|". $_POST["txtReceiveAccount"]."|".$_POST["txtOrderID"]."|".$_POST["txtUrlReturn"]."|".$_POST["txtWebsiteID"]."|".$_POST["txtSecret"];
		echo $plaintext;

		$sign = strtoupper(hash('sha256', $plaintext));
		
		$data = "?website_id=" . $_POST["txtWebsiteID"] . "&currency=" . $_POST["txtCurency"] . "&reference_number=" . $_POST["txtOrderID"] . "&amount=" . $_POST["txtTotalAmount"] . "&receiver_account=" .  $_POST["txtReceiveAccount"]. "&url_return=" .  urlencode($_POST["txtUrlReturn"]). "&signature=" . $sign. "&payment_type=" . $_POST["txtParamExt"];
		
		
		$bill_to_surname = htmlentities($_POST["txtCustomerFirstName"]);
		$bill_to_forename = htmlentities($_POST["txtCustomerLastName"]);
		$bill_to_address = htmlentities($_POST["txtBillAddress"]);
		$bill_to_address_city = htmlentities($_POST["txtCity"]);
		$bill_to_email = htmlentities($_POST["txtCustomerEmail"]);
		$bill_to_phone = htmlentities($_POST["txtCustomerMobile"]);
		$language=htmlentities($_POST["txtParamLanguage"]);
		
		//$data = $data . "&bill_to_surname=" . $bill_to_surname. "&bill_to_forename=" . $bill_to_forename. "&bill_to_phone=" . $_POST["txtCustomerMobile"]. "&bill_to_address=" . $bill_to_address.  "&bill_to_address_city=" . $bill_to_address_city."&bill_to_email=" . $bill_to_email ."&language=".$language;

		$destinationUrl = $destinationUrl . $data;
		echo "||||".$destinationUrl;
				//exit();
	header('Location: ' .$destinationUrl);
	}

?>