<?php
		include('header.php');
?>
<?php
include('../admin/mymethod.php');
//session_start();
if(!isset($_SESSION['email']))
{
	header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Page</title>
	<link rel="icon" href="img/favicon.png">
		
	<?php
			include('csslink.php');
		?>
</head>
<body>
	<?php
		
		if(isset($_GET['doc_id']))
		{
			$doc_id = $_GET['doc_id'];
			$email=$_SESSION['email'];
			$result = getDoctorData($doc_id);
		
			$row = $result->fetch_assoc();
		}
		 
	?>
	

  <!-- Start Appointment -->
  <section class="appointment">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>We Are Always Ready to Help You. Book An Appointment</h2>
							<img src="img/section-img.png" alt="#">
							<p>The customer is very happy to be able to meet the customer's current needs & prices.</p>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-6 col-md-12 col-12">
						<form class="form" action="" method="post">
							<input name="doc_id" type="hidden" value="<?php echo htmlspecialchars($doc_id); ?>">
							<input name="email" type="hidden" value="<?php echo htmlspecialchars($email); ?>">
							
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<input name="username" type="text" placeholder="Name" value="<?php echo htmlspecialchars($row['username'] ?? ''); ?>" required>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<input type="date" placeholder="Date" id="datepicker" name="app_date" required>
									<input type="time" placeholder="Time" id="" name="app_time" required>
								</div>
							</div>
							
							<div class="col-lg-12 col-md-12 col-12">
								<div class="form-group">
									<textarea name="app_msg" placeholder="Write Your Message Here....." required></textarea>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-5 col-md-4 col-12">
									<div class="form-group">
										<div class="button">
											<button type="submit" class="btn" name="submit">Book An Appointment</button>
										</div>
									</div>
								</div>
								<div class="col-lg-7 col-md-8 col-12">
									<p>(We will confirm by a text message)</p>
								</div>
							</div>
						</form>
					</div>
					<div class="col-lg-6 col-md-12 ">
						<div class="appointment-image">
							<img src="img/contact-img.png" alt="#">
						</div>
					</div>

					<?php
						if(isset($_POST['submit']))
						{
							$response = appointment($_POST);
							if($response==1)
							{
								echo '<script>alert("Your appointment has been booked successfully.");</script>';
							} 
							else 
							{
								echo '<script>alert("Error: ' . $response . '");</script>';
							}
							
						}
					?>
					
				</div>
			</div>
		</section>
		<!-- End Appointment -->  
		<?php
  			include('jslink.php');
  		?>
</body>
</html>