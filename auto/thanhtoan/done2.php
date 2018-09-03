<?php   
    WriteResultToFile();
	function WriteResultToFile()
    {
        $fh = fopen("data". DIRECTORY_SEPARATOR  ."data.txt", 'w');
		$secret_key= "Nobita20385@gmail.com";
		
		$websiteid = $_GET["website_id"];
		
		$amount = $_GET["amount"];
		$message = $_GET["message"];
		$payment_type=$_GET["payment_type"];
		$reference_number=$_GET["reference_number"];
		$status = $_GET["status"];
		$trans_ref_no = $_GET["trans_ref_no"];
		$sign = $_GET["signature"];
		$data = $amount . "-" . $message . "-" . $payment_type . "-" . $reference_number. "-" . $status. "-" . $trans_ref_no. "-" . $websiteid;
		$plaintext = $amount . "|" . $message . "|" . $payment_type . "|" . $reference_number. "|" . $status. "|" . $trans_ref_no. "|" . $websiteid. "|" . $secret_key;
		$mysign = strtoupper(hash('sha256', $plaintext));
		
		if($mysign != $sign)
            {
                fwrite($fh, "Fail to validate data");
            }
		else
		{
			if($status == 1)
            {
                fwrite($fh, "Payment is Successful !\n");
            }
            else if($status == 0)
            {
                fwrite($fh, "Payment is Pending!\n");
            }
			else if($status == -1)
            {
                fwrite($fh, "Payment is Failed!\n");
            }
			else if($status == -5)
            {
                fwrite($fh, "OrderID is not valid");
            }
			else if($status == -6)
            {
                fwrite($fh, "Account's balance is insufficient");
            }
			else
            {
                fwrite($fh, "Payment is Not Success!\n");
            }
		}

		fwrite($fh,sprintf("Data = %s\t#\t sign=%s\t",$data,$sign));
		fclose($fh);
		ShowResult();
    }
	
    function ShowResult(){
        $handle = fopen("data". DIRECTORY_SEPARATOR  ."data.txt", "r");
        $contents = fread($handle, filesize("data". DIRECTORY_SEPARATOR ."data.txt") + 1);
        fclose($handle);
        echo $contents;
    }


?>