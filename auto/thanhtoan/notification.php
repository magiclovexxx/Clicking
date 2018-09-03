<?php 

		$secret_key= "Nobita20385@gmail.com";
		$data = $_POST["data"];
		$sign = $_POST["sign"];

		 $plaintext = $data . "|" . $secret_key;
		 $mysign = strtoupper(hash('sha256', $plaintext));
		 if($mysign != $sign)
             {
                 fwrite($fh, "Fail to validate data");
             }
		 else
		 {
			 $string = explode ('|' , $string);
			 $amount = $string[0];
			 $status = $string[1];
			if($status == 1)// thanh toán thành công
           {
                 fwrite($fh, "Payment is Successful !\n");
				 fwrite($fh, "Amount = $amount !\n");
           }
			 else if($status == 7)
			 {
				 fwrite($fh, "Payment is Successful (pay with pending)!\n");
			 }
            else if($status == 0)// Giao dịch thất bại - mới chỉ ở trạng thái khở tạo
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

?>