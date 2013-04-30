<?php
if(isset($_POST['email'])) {
     
  // The message
$message = "blah blah blah";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
mail('davidmuirdesign@gmail.com', 'My Subject', $message);
?>



<?php
}
?> 
