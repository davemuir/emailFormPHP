<?php
if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $to = "davidmuirdesign@gmail.com";
    $subject = "Ordering form for reeds";
     
     
    function died($error) {
        // your error code can go here
        echo "sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $message = '<html>
    				<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<title>Sound supreme orders</title>
					</head>
					<body>
						<p>Form details below'."\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $message .= "First Name: ".clean_string($first_name)."\n";
    $message .= "Last Name: ".clean_string($last_name)."\n";
    $message .= "Email: ".clean_string($email_from)."\n";
    $message .= "Telephone: ".clean_string($telephone)."\n";
    $message .= "Comments: ".clean_string($comments)."\n";
    $message .= "</p></body></html>"."\n";
    
     // Fix any bare linefeeds in the message to make it RFC821 Compliant. 
     //$message = preg_replace("#(?<!\r)\n#si", "\n", $message); 
    
          
    	// create email headers
		$headers = 'MIME-Version:1.0'. "\n";
		$headers .= 'Content-type:text/html; charset=utf-8'. "\n" ;
		$headers .= 'From:Sender Name <sender@domain.com>' . "\n";
		$headers .= 'Subject:'.$subject. "\n";
		$headers .= "X-Mailer: PHP/".phpversion();
		
	
	// Make sure there are no bare linefeeds in the headers 
  //  $headers = preg_replace('#(?<!\r)\n#si', "\n", $headers); 

	
	mail($to, $subject, $message, $headers);   //implode("\n", $headers)); 
	
	 echo "email processed bitch<br /><br /><a href='http://ecommercetesting.herokuapp.com'>back to soundsupreme</a><br />";
	 echo "from:".$email_from." <br />";
	 echo "to:".$to."<br />";
	 echo "message:".$message."<br />";
	 echo "headers".$headers;


?>

<?php
}
?> 
