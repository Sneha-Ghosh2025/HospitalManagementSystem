<?php
    include('../admin/mymethod.php');
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
	include('csslink.php');
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management - Doctors</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9faz;
}

.doctor-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.doctor-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 250px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.doctor-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.doctor-img {
    width: 100%;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    height: 150px;
    object-fit: cover;
}

.doctor-name {
    margin: 10px 0 5px;
    font-size: 1.2rem;
    color: #007bff;
}

.doctor-specialization {
    font-weight: bold;
    color: #555;
}

.doctor-details {
    color: #666;
    margin: 5px 0;
}

.appointment-btn {
    display: inline-block;
    margin: 10px 0 20px;
    padding: 10px 15px;
    font-size: 1rem;
    font-weight: bold;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.appointment-btn:hover {
    background-color: #218838;
}


</style>
<body>
    <?php
        // include('header.php');
    ?>
    <header class="header">
        <h1><center><b>Our Doctors</b></center></h1>
    </header>
    <main class="doctor-list">
        <?php
         $result= displayDoctorDetails();
         if($result->num_rows>0)
         {
            while($row = $result->fetch_assoc())
            {
                echo '
                    
                    <!-- Doctor Profile Card -->
                    <div class="doctor-card">
                    
                    <img src="../admin/'.$row["doc_img"].'" alt="Doctor Image" class="doctor-img">
                    <h2 class="doctor-name">'.$row["username"].'</h2>
                    <p class="doctor-specialization">'.$row["specialization"].'</p>
                    <p class="doctor-details">Experience:'.$row["experience"].'years</p>
                    <p class="doctor-details">Contact:'.$row["email"].'</p>
                    <button class="appointment-btn" onclick="bookAppointment('.$row["doc_id"].')">Book Appointment</button>
                    </div>
                ';
            }
         }
        ?>
        

        <!--<div class="doctor-card">
            <img src="doctor2.jpg" alt="Doctor Image" class="doctor-img">
            <h2 class="doctor-name">Dr. Jane Smith</h2>
            <p class="doctor-specialization">Neurologist</p>
            <p class="doctor-details">Experience: 10 Years</p>
            <p class="doctor-details">Contact: jane.smith@example.com</p>
            <button class="appointment-btn">Book Appointment</button>
        </div>-->

        <!-- Add more doctor cards as needed -->
    </main>

    <footer class="footer">
        <p><center>&copy; 2024 Hospital Management System</center></p>
    </footer>
    <script>
        function bookAppointment(doc_id) 
        {
            //alert(Booking an appointment with ${doctorName});
            // Redirect to appointment page or show modal here
            window.location.href=`appointment.php?doc_id=${doc_id}`;
        }
    </script>
    <?php
         include('jslink.php');
     ?>
</body>
</html>