<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);


    if ($name == "" OR $email == "" OR $message == "") {
        $error = "You must specify a value for name, email address, and message.";
		header("Location: contact.php?status=error");
        exit;
    }


    $email_body = "";
    $email_body = $email_body . "Name: " . $name . "<br>";
    $email_body = $email_body . "Email: " . $email . "<br>";
    $email_body = $email_body . "Message: " . $message;

    $address = "bryanmcd.gt@gmail.com";
    $subject = "Email from BryanMcDonald.com";

    mail($address,$subject,$email_body);
	
	mail($address, 
	$subject,
	$email_body,
	"FROM: bryan@pvaweb.com",
	"-fbryanmcd.gt@gmail.com");
	
    header("Location: contact.php?status=thanks");
    exit;
}
?>
 
<!-- Navigation Menu -->
<?php
	include 'includes/header.php';
?>
	  
    <!-- Full Page Image Header Area -->
    <div id="top" class="header">
      <div class="vert-text">
        <div class="container">
	
					<?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
			                <h2>Thanks for the email! I&rsquo;ll be in touch shortly!<br><br>
								Click <a href="http://www.appraisalzen.com">Here</a> to return to the main page.</h2>
			            <?php } else { ?>
			            	
							<h2>I&rsquo;d love to hear from you!<br>Complete the form to send me an email.</h2>
										
							  <form method="post" action="contact.php" class="form-signin">
							    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" autofocus>
							    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" >
							    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your Message"></textarea>
							    <button class="btn btn-lg btn-primary btn-block" type="submit">Send Email</button>
							  </form> <!-- /form -->
							  
							  <?php if (isset($_GET["status"]) AND $_GET["status"] == "error") { 
							  		echo "<h2>Please fill out the form completely.</h2>";
									}
							  	?>
			
						<?php } ?>
										
    	</div> <!-- /container -->
      </div>
    </div>
    <!-- /Full Page Image Header Area -->
    
    <!-- Footer -->
	<?php
		include 'includes/footer.php';
	?>
	<!-- /Footer -->
	
	<!-- Bootstrap core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Custom JavaScript for Smooth Scrolling -->
    <script src="js/custom.js"></script>

  </body>

</html>
