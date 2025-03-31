<?php
    include('mymethod.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <?php
			include('../user/csslink.php');
		?>
    <style>
       
        header1{
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
        }
        .container1 {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-header .info {
            flex: 1;
        }
        .profile-header .info h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .profile-header .info p {
            margin: 5px 0;
            color: #555;
        }
        .details {
            margin-top: 20px;
        }
        .details h2 {
            font-size: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            color: #333;
        }
        .details ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }
        .details ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            color: #555;
        }
        .details ul li:last-child {
            border-bottom: none;
        }
        .btn-container {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
        include('../user/header.php');
        $doc_id = $_SESSION['email'];

    ?>
    <header1>
        <h1>Doctor Profile</h1>
    </header1>
    <div class="container1">
    <?php
        $email= $_SESSION['email'];
        $result = doctorDisplay($email);
        $row= $result->fetch_assoc();
        
    ?>
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($row["doc_img"]);?>" alt="Doctor's Profile Picture">
            <div class="info">
                <h1>Dr. <?php echo $row["username"];?></h1>
                
                <table>
                    
                
                  <tbody>

        <?php
         
            /*echo'
              <tr align="center">
            <td>'.$row["username"].'</td>
            <td>'.$row["email"].'</td>
            <td>'.$row["contact"].'</td>
             <td>'.$row["specialization"].'</td>
            <td>'.$row["experience"].'</td>
          </tr>
            ';*/
          
        ?>
        </tbody>
                </table>
                <p><strong>Specialization:</strong> <?php echo htmlspecialchars($row["specialization"]); ?></p>
                <p><strong>Experience:</strong><?php echo htmlspecialchars($row["experience"]); ?></p>
            </div>
        </div>
        <div class="details">
            <h2>Contact Information</h2>
            <ul>
                <li><strong>Email:</strong> <?php echo htmlspecialchars($row["email"]); ?></li>
                <li><strong>Phone:</strong><?php echo htmlspecialchars($row["contact"]); ?> </li>
            </ul>
        </div>
        <div class="details">
            <h2>About</h2>
            <p><?php echo htmlspecialchars($row["about"]); ?></p>
        </div>
        <div class="details">
            <h2>Available Timings</h2>
            <ul>
                <li>Monday - Friday: 9:00 AM - 5:00 PM</li>
                <li>Saturday: 10:00 AM - 2:00 PM</li>
                <li>Sunday: Closed</li>
            </ul>
        </div>
       
    </div>
    <?php
  			include('../user/jslink.php');
  		?>
</body>
</html>
