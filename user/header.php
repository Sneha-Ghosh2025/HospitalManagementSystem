<?php
	session_start();
?>
<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="#">About</a></li>
								<li><a href="#">Doctors</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+880 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">support@yourmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.php"><img src="img/logo.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
										<li class="active"><a href="../user/index.php">Home <i class="icofont-rounded-down"></i></a></li>
											
											<!--/Doctors Page-->
											<?php
												
						
												if(isset($_SESSION['email']) && $_SESSION['type']=='doctor')
												{
											?>
												

													<li><a href="../admin/docProfile.php">Profile </a></li>
													<li><a href="../admin/doctorAppointmentDisplay.php">Appointment </a></li>
													<li><a href="logout.php">Logout </a></li>

											<?php
												}
												
												else if (isset($_SESSION['email']) && $_SESSION['type']=='user'){
											?>	
													<!-- User -->
														<li><a href="#">Profile </a></li>
														<li><a href="appointment.php">Appointment </a></li>
														<li><a href="Userdisplay.php">Booking</a></li>
														<li><a href="#">Search</a></li>
														<li><a href="logout.php">Logout </a></li>
		     								<?php
												}
												else if(isset($_SESSION['email']) && $_SESSION['type']=='employee'){
											?>
													<li><a href="#">Profile </a></li>
														<li><a href="#">Appointment </a></li>
														<li><a href="logout.php">Logout </a></li>
											<?php			
												}
												else{
											?>
													<!--/Service Page-->
													<li><a href="#">Services </a></li>
													<!--/Contact Page-->
													<li><a href="contact.html">Contact Us</a></li>
													<li><a href="../admin/login.php">Doctor</a></li>
													<li><a href="login.php">User</a></li>
											<?php
												}
											?>

											
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
<?php
ob_end_flush();
?>